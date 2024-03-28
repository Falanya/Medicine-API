<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function index() {
        $config = 'dashboard.chats.index';
        $auth = auth()->user();
        return view('dashboard.layout', compact('config','auth'));
    }
}
