<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function show_api() {
        return view('admin.apis');
    }

    public function setting() {
        return view('admin.setting');
    }

}
