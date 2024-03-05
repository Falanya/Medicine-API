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

class AccountController extends Controller
{
    public function login() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        return view('account.login', compact('proTypes'));
    }

    public function check_login(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $data = $request->only(['email','password']);

        $data_check = auth('web')->attempt($data);

        if($data_check) {
            if(auth('web')->user()->email_verified_at == '') {
                auth('web')->logout();
                return redirect()->back()->with('no','Your account is not verify, please check email again!');
            }
            
            return redirect()->route('home.index')->with('ok','Welcome back');
        }

        return redirect()->back()->with('no','User email or password invalid');
    }

    public function register() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        return view('account.register', compact('proTypes'));
    }

    public function check_register(Request $request) {
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
            return redirect()->route('account.login')->with('ok','User created successfully, please check your mail to verify account');
        }

        return redirect()->back()->with('no','somthing error, please try again');
    }

    public function verify_account($email) {
        User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('ok','Verify account successfully, Now you can login again');
    }

    public function check_logout() {
        auth()->logout();
        return redirect()->route('home.index')->with('ok','You are logout');
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
            return redirect()->back();
        }
    }

    public function forgot_password() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        return view('account.forgot-password', compact('proTypes'));
    }

    public function process_forgot_password(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(60);

        $existsEmail = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if($existsEmail) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        }

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $user = User::where('email', $request->email)->first();

        $formData = [
            'token' => $token,
            'user' => $user,
            'mailSubject' => 'You have requested to reset your password.'
        ];
        Mail::to($request->email)->send(new ResetPassword($formData));

        return redirect()->route('account.login')->with('ok','Please check email to reset password');
    }

    public function reset_password($token) {
        $proTypes = DB::table('product_types')->orderBy('name','ASC')->get();
        $tokenExists = DB::table('password_reset_tokens')->where('token', $token)->first();
        if($tokenExists == null) {
            return redirect()->route('account.forgot_password')->with('no','Invalid request');
        }
        return view('account.reset-password', compact('proTypes','token'));
    }

    public function process_reset_password(Request $request) {
        $token = $request->token;
        $tokenExists = DB::table('password_reset_tokens')->where('token',$token)->first();
        if($tokenExists == null) {
            return redirect()->route('account.forgot_password')->with('no','Invalid request');
        }
        $user = User::where('email',$tokenExists->email)->first();
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('account.login')->with('ok','Reset password successfully');
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
            return redirect()->back()->with('ok','Update your profile successfully');
        }
        return redirect()->back()->with('no','Something error, please check again');

    }

    public function show_promotions() {
        
    }

    

    

}
