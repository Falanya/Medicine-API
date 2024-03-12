<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Services\Interfaces\ProvinceServiceInterface as ProvinceService;

class UserController extends Controller
{
    protected $userService;
    protected $provinceService;

    public function __construct(
        UserService $userService,
        ProvinceService $provinceService,
    ) {
        $this->userService = $userService;
        $this->provinceService = $provinceService;
    }
    
    public function index() {
        $users = $this->userService->paginate();
        $config = [
            'js' => [
                'js/plugins/switchery/switchery.js'
            ],
            'css' => [
                'css/plugins/switchery/switchery.css',
            ]
        ];
        $config['seo'] = config('apps.user');
        $template = 'dashboard.user.index';
        return view('dashboard.layout', compact('template','config','users'));
    }

    public function create() {
        $provinces = $this->provinceService->all();
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'libary/location.js'
            ]
        ];
        $config['seo'] = config('apps.user');
        $template = 'dashboard.user.create';
        return view('dashboard.layout', compact('config','template','provinces'));
    }

    public function post_create() {
        
    }

    public function edit() {
        
    }
}