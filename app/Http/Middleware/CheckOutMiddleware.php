<?php

namespace App\Http\Middleware;

use App\Composers\CartComposer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOutMiddleware
{
    protected $cartComposer;

    public function __construct(CartComposer $cartComposer)
    {
        $this->cartComposer = $cartComposer;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->cartComposer->countProduct() > 0){
            return $next($request);
        }else{
            return back()->with(['error'=>'Chưa có sản phẩm trong giỏ hàng']);
        }
    }
}
