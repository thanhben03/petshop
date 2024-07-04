<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('level')) {
            if ($request->path() != '/') {
                return redirect()->route('login');
            }
            return response([
                'msg' => 'Vui lòng đăng nhập để tiếp tục sử dụng !',
                'status' => 'error',
                'directUrl' => route('login')
            ]);
        }
        return $next($request);
    }
}
