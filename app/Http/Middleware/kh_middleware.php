<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



    
class kh_middleware
{
    private $khachhang;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         if(!Auth::guard('khachhang')->check()){
             return redirect()->route('Home.dangnhap')->with('no','Vui lòng đăng nhập hệ thống');
         }elseif (Auth::guard('khachhang')->user()->status == 0) {
             Auth::guard('khachhang')->logout();
             return redirect()->route('Home.dangnhap')->with('no','Tài khoản chưa được kích hoạt');
         }
         return $next($request);
    }    
}
