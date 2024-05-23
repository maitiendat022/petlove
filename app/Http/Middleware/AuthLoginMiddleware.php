<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::id() == null){
            session(['url.intended' => $request->url()]);
            return redirect()->route('auth.loginIndex')->with('warning','Vui lòng đăng nhập để thực hiện');
        }else{
            return $next($request);
        }

    }
}
