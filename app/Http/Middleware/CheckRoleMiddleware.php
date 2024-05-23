<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$id): Response
    {
        if (Auth::check() && in_array(Auth::user()->role->id, $id)) {
            return $next($request);
        }else{
            return back()->with('warning','Bạn không có quyền truy cập');
        }
    }
}
