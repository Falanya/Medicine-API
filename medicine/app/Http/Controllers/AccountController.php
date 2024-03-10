<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Mail\VerifyAccount;
use App\Models\ProductType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;

class AccountController extends Controller
{
    public function login() {
        if(auth()->user()) {
            return redirect()->route('home.index');
        }
        return view('account.login');
    }

    public function check_login(AuthRequest $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $data = $request->only(['email','password']);

        $data_check = auth('web')->attempt($data);

        if($data_check) {
            if(auth('web')->user()->email_verified_at == '') {
                auth('web')->logout();
                return redirect()->back()->with('error','Tài khoản của bạn chưa xác thực, hãy kiểm tra hộp thư email');
            }
            
            return redirect()->route('home.index')->with('success','Chào mừng đến với Medicine Mart');
        }

        return redirect()->back()->with('error','Email hoặc mật khẩu không đúng');
    }

    public function register() {
        if (auth()->user()) {
            return redirect()->route('home.index');
        }
        return view('account.register');
    }

    public function check_register(RegisterRequest $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
            'fullname' => 'required|min:5',
            'gender' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $data = $request->only('email','fullname','gender');
        $data['password'] = bcrypt(request('password'));

        if($user = User::create($data)) {
            Mail::to($user->email)->send(new VerifyAccount($user));
            return redirect()->route('account.login')->with('success','Đăng ký thành công, hãy kiểm tra hộp thư email của bạn');
        }

        return redirect()->back()->with('error','Có một vài lỗi, hãy thử lại');
    }

    public function verify_account($email) {
        User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('success','Verify account successfully, Now you can login again');
    }

    public function check_logout() {
        auth()->logout();
        return redirect()->route('home.index')->with('success','You are logout');
    }

    public function change_password() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        return view('account.change-password', compact('proTypes','auth'));
    }

    public function check_change_password(Request $request) {
        $user = auth()->user();
        $request->validate([
            'password_confirm' => ['required', function($attr,$value,$fail) use($user) {
                if(!Hash::check($value, $user->password)) {
                    return $fail('Your password is incorrect, please check again');
                }
            }],
            'password' => 'required|min:6',
            'new_password_confirm' => 'required|same:password'
        ]);
        $data['password'] = bcrypt(request('password'));
        $check = User::where('email', $user->email)->update($data);
        if($check) {
            return redirect()->back()->with('success','Password changed successfully');
        } else {
            return redirect()->back()->with('error','Something errors, please try again');
        }
    }

    public function profile() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        return view('account.profile', compact('proTypes','auth'));
    }

    public function check_profile(Request $request) {
        $user = auth()->user();
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'fullname' => 'required',
            'gender' => 'required',
            'password' => ['required', function($attr, $value, $fail) use($user) {
                if(!Hash::check($value, $user->password)) {
                    return $fail('Your password is incorrect');
                }
            }],
        ]);

        $data = $request->only('fullname','gender');
        $check = $user->update($data);
        if($check) {
            return redirect()->back()->with('success','Update your profile successfully');
        }
        return redirect()->back()->with('error','Something error, please check again');

    }

    public function forgot_password() {
        return view('medicine.forgot-password');
    }

    public function process_forgot_password(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $existEmail = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if($existEmail) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        }
        $token = Str::random(60);
        $user = User::where('email', $request->email)->first();
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $formData = [
            'user' => $user,
            'token' => $token,
        ];

        Mail::to($request->email)->send(new ResetPassword($formData));

        return redirect()->route('account.login')->with('success','Please check mail to verify');
    }

    public function reset_password($token) {
        $tokenExists = DB::table('password_reset_tokens')->where('token', $token)->first();
        if($tokenExists == null) {
            return redirect()->route('account.forgot_password')->with('no','Invalid request');
        }
        return view('medicine.reset-password', compact('token'));
    }

    public function process_reset_password(Request $request) {
        $request->validate([
            'token' => 'required|exists:password_reset_tokens,token',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        $token = $request->token;
        $tokenExists = DB::table('password_reset_tokens')->where('token',$token)->first();
        $user = User::where('email',$tokenExists->email)->first();
        if($tokenExists == null) {
            return redirect()->route('account.forgot_password')->with('no','Invalid request');
        }
        User::where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('account.login')->with('success','Reset password successfully');
    }

    public function show_promotions() {
        
    }

}
