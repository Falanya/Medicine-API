<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $auth = auth()->user();
        $config = 'dashboard.home.index';
        return view('dashboard.layout', compact('auth','config'));
    }
}