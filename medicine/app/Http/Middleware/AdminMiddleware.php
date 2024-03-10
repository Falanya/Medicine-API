<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::id() == null) {
            return redirect()->route('account.login')->with('error','Bạn chưa đăng nhập');
        }
        elseif(auth()->user()->role_id == 1) {
            return redirect()->route('home.index')->with('error','Bạn không đủ quyền hạn');
        }
        return $next($request);
    }
}
