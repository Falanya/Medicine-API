<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index() {
        $config = 'dashboard.promotions.index';
        $auth = auth()->user();
        return view('dashboard.layout', compact('config','auth'));
    }

}
