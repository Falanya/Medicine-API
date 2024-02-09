<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAccountApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UsersApiController extends Controller
{
    public function check_register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->all(),
                'status_code' => 422,
                'message' => 'User not created successfully'
            ]);
        }

        $data_check = $request->all('fullname','email','gender');
        $data_check['password'] = bcrypt(request('password'));

        if ($data=User::create($data_check)) {
            Mail::to($data->email)->send(new VerifyAccountApi($data));
            return response()->json([
                'data' => $data,
                'status_code' => 200,
                'message' => 'User created successfully, please check your mail to verify account'
            ]);
        }
    }

    public function verify_account($email) {
        if ($user = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail()) {
            if (User::where('email', $email)->update(['email_verified_at' => now()])) {
                return response()->json([
                    'data' => $user,
                    'status_code' => 200,
                    'message' => 'Verify account successfully, Now you can login again',
                ]);
            }
            return response()->json([
                'data' => null,
                'status_code' => 422,
                'message' => 'Could not verify user email'
            ]);
        }
        return response()->json([
            'data' => null,
            'status_code' => 422,
            'message'=> 'Could not find user email'
        ]);
    }

    public function check_login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
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
                auth()->logout();
                return response()->json([
                    'data' => null,
                    'message' => 'Could not login, please verify email',
                    'status_code' => '422',
                ]);
            }

            $user = User::Where('email',$data['email'])->first();
            $token = $user->createToken('LOGIN TOKEN', ['*'], now()->addWeek())->plainTextToken;
            return response()->json([
                'data' => $data,
                'token' => $token,
                'status_code' => 200
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

    public function profile() {
        $user = auth()->user();
        $data = User::find($user->id);
        if ($data_check = $data->addresses) {
            return response()->json([
                'data' => $data_check,
                'status_code' => 200
            ]);
        }
    }
}
