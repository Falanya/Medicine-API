<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\ResetPassword;
use App\Mail\ResetPasswordApi;
use App\Mail\VerifyAccountApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsersApiController extends Controller
{
    public function check_register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'bail|required|string|min:6',
            'email' => 'bail|required|email|unique:users',
            'gender' => 'bail|required',
            'phone' => 'bail|required|numeric',
            'birthday' => 'bail|required',
            'password' => 'bail|required|min:6',
            'confirm_password' => 'bail|required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->all(),
                'status_code' => 422,
                'message' => 'User not created successfully'
            ]);
        }

        $data_check = $request->all('fullname','email','gender','phone');
        $birthday = Carbon::createFromFormat('Y-m-d', $request->birthday);
        $data_check['birthday'] = $birthday->format('Y-m-d');
        $data_check['password'] = bcrypt(request('password'));

        if ($data=User::create($data_check)) {
            Mail::to($data->email)->send(new VerifyAccountApi($data));
            return response()->json([
                'status_code' => 200,
                'message' => 'Please check your mail to verify account!!!'
            ]);
        }
    }

    public function verify_account($email) {
        if (User::where('email', $email)->whereNull('email_verified_at')->firstOrFail()) {
            if (User::where('email', $email)->update(['email_verified_at' => now()])) {
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Verify account successfully, Now you can login again',
                ]);
            }
            return response()->json([
                'status_code' => 422,
                'message' => 'Could not verify user email'
            ]);
        }
        return response()->json([
            'status_code' => 422,
            'message'=> 'Could not find user email'
        ]);
    }

    public function check_login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->all(),
                'status_code' => 422,
                'message' => 'Could not login'
            ]);
        }

        $data = $request->only('email','password');
        $data_check = auth()->attempt($data);

        if($data_check) {
            if(auth()->user()->email_verified_at == '') {
                return response()->json([
                    'message' => 'Could not login, please verify email',
                    'status_code' => 422,
                ]);
            }

            if(auth()->user()->status == 0) {
                return response()->json([
                    'message' => 'Account has been locked, please try again',
                    'status_code' => 422,
                ]);
            }

            $user = User::Where('email',$data['email'])->first();
            $token = $user->createToken('LOGIN TOKEN', ['*'], now()->addWeek())->plainTextToken;
            return response()->json([
                'token' => $token,
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'Your password is incorrect, please check again'
            ]);
        }
    }

    public function logout() {
        $check_logout = auth()->user()->currentAccessToken()->delete();
        if($check_logout) {
            return response()->json([
                'message' => 'Account logouted successfully',
                'status_code' => 200
            ]);
        }
        return response()->json([
            'message' => 'Something errors, please check again',
            'status_code' => 404
        ]);
    }

    public function delete_all_tokens() {
        $auth = auth()->user();
        if($auth) {
            $auth->tokens()->delete();
            return response()->json([
                'message' => 'Tokens deleted successfully',
                'status_code' => 200
            ]);
        }
        return response()->json([
            'message' => 'Not find user, please check again',
            'status_code' => 404
        ]);
    }

    public function profile() {
        $user = auth()->user();
        if(!$user) {
            return response()->json([
                'data' => null,
                'status_code' => 404,
                'message' => 'Something errors, please check again'
            ]);
        }
        return response()->json([
            'data' => $user,
            'status_code' => 200,
            'message' => 'Success'
        ]);
    }

    public function profile_for_app() {
        $auth = auth()->user()->id;
        if($auth) {
            $user = new UserResource(User::findOrFail($auth));
            return $user;
        } else {
            return response()->json([
                'message' => 'You are not login',
                'status_code' => 401,
            ]);
        }
    }

    public function change_profile(Request $request) {
        $auth = auth()->user();
        $validator = Validator::make($request->all(), [
            'fullname' => 'bail|required|string|min:6',
            'gender' => 'bail|required',
            'phone' => 'required|numeric',
            'birthday' => 'required',
            'confirm_password' => ['bail', 'required', function($attr,$value,$fail) use($auth) {
                if(!Hash::check($value, $auth->password)) {
                    $fail('Your password is incorrect, please try again');
                }
            }],
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status_code' => 404
            ]);
        }

        $data = $request->only('fullname','gender','phone');
        $birthday = Carbon::createFromFormat('Y-m-d', $request->birthday);
        $data['birthday'] = $birthday->format('Y-m-d');
        $user = User::where('email', $auth->email)->first();
        $check = $user->update($data);
        if($check) {
            return response()->json([
                'data' => $auth,
                'status_code' => 200,
                'message' => 'Your profile updated successfully'
            ]);
        }
        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message' => 'Something errors, please check again'
        ]);
    }

}
