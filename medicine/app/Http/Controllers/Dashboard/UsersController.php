<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Mail\VerifyAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index() {
        $auth = auth()->user();
        $config = 'dashboard.users.index';
        $users = UsersResource::collection(User::orderBy('id','ASC')->paginate(20));
        foreach ($users as $user) {
            if (!empty($user['birthday'])) {
                $user['birthday'] = date('d-m-Y', strtotime($user['birthday']));
            }
        }

        return view('dashboard.layout', compact('auth','config','users'));
    }

    public function create() {
        $config = 'dashboard.users.create';
        $auth = auth()->user();
        return view('dashboard.layout', compact('auth','config'));
    }

    public function post_create(Request $request) {
        $request->validate([
            'fullname' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|numeric',
            'phone' => 'required|numeric|min:9',
            'birthday' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        $data = $request->only('fullname','email','gender','phone','birthday');
        $data['role_id'] = 2;
        $data['password'] = bcrypt(request('password'));
        $user = User::create($data);
        if ($user) {
            Mail::to($request->email)->send(new VerifyAccount($user));
            return redirect()->route('dashboard.users.index')->with('success','Tạo thành viên thành công');
        } else {
            return redirect()->back()->with('error','Tạo thành viên không thành công');
        }
    }

    public function delete(User $user) {
        if($user->email_verified_at == null) {
            $delete = $user->delete();
            if($delete) {
                return redirect()->back()->with('success','Xóa tài khoản thành công');
            }
            return redirect()->back()->with('error','Xóa tài khoản không thành công');
        }
        return redirect()->back()->with('error','Chỉ có thể xóa tài khoản chưa xác minh email');
    }

    public function update_status($id) {
        $user = User::find($id);
        if($user) {
            if($user->status == 1) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }
            $user->save();
            return response()->json(['message' => 'Cập nhật trạng thái người dùng thành công', 'success' => true]);
        }
        return response()->json(['message' => 'Không tìm thấy người dùng', 'success' => false]);
    }
}
