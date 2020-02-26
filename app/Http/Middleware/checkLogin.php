<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::check()) {
    //         // $request->is_login = true;
    //         echo '登入';
    //     }else{
    //         // $request->is_login = false;
    //         echo '登出';
    //     }
    //     $request->is_login = 123;
    //     return $next($request);
    // }
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            echo('yes');
            // return redirect(route('trade'));
        }
        else{
            echo('no');
        }

        return $next($request);
    }
}
