<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }
    
    public function index() {
        $users = $this->userService->paginate();
        $config = $this->config();
        $template = 'dashboard.user.index';
        return view('dashboard.layout', compact('template','config','users'));
    }

    private function config(){
        return [
            'js' => [
                'js/plugins/switchery/switchery.js'
            ],
            'css' => [
                'css/plugins/switchery/switchery.css',
            ]
        ];
    } 

}