<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $config = $this->config();
        $template = 'dashboard.user.index';
        return view('dashboard.layout', compact('template','config'));
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