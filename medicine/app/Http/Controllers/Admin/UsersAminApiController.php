<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersAminApiController extends Controller
{
    public function show() {
        $auth = auth()->user();
        if($auth->role_id == 2) {
            $users = User::orderBy('id','ASC')->get();
            return ['data' => UsersResource::collection($users), 'status_code' => 200];
        }
        return response()->json([
            'message' => 'Verify Not success',
            'status_code' => 401,
        ]);
    }

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status_code' => 401,
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if($user) {
            $data = new UsersResource($user);
            return ['data' => $data,'status_code' => 200];
        }
        return response()->json([
            'message' => 'Email is invalid',
            'status_code' => 401,
        ]);
    }

    public function change_status($id) {
        $auth = auth()->user();
        if($auth->role_id == 2) {
            $user = User::find($id);
            if($user) {
                if($user->status == 1) {
                    DB::table('personal_access_tokens')->where('tokenable_id', $id)->delete();
                    $user->status = 0;
                } else {
                    $user->status = 1;
                }
                $user->save();
                return response()->json([
                    'message' => 'Change status successfully',
                    'status_code' => 200,
                ]);
            }
            return response()->json([
                'message' => 'Cannot find user',
                'status_code' => 401,
            ]);
        }
        return response()->json([
            'message' => 'Verify Not success',
            'status_code' => 401,
        ]);
    }

    public function delete($id) {
        $auth = auth()->user();
        if($auth->role_id == 2) {
            $user = User::find($id);
            if($user) {
                if($user->email_verified_at == null) {
                    $check = $user->delete();
                    if($check) {
                        return response()->json([
                            'message' => 'User deleted',
                            'status_code' => 200,
                        ]);
                    }
                    return response()->json([
                        'message' => 'Something errors, please try again',
                        'status_code' => 401,
                    ]);
                }
                return response()->json([
                    'message' => 'User verified, so cannot delete',
                    'status_code' => 401,
                ]);
            }
            return response()->json([
                'message' => 'Cannot find user',
                'status_code' => 401,
            ]);
        }
        return response()->json([
            'message' => 'Verify Not success',
            'status_code' => 401,
        ]);
    }
}