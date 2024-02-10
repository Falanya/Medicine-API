<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        return view('account.forgot_password');
    }

    public function check_forgot_password() {

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

    public function reset_password() {
        return view('account.reset_password');
    }

    public function check_reset_password() {

    }

}