<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
} 