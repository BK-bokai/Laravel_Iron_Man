<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;


class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            Session::put('is_login', True);
            $user = Auth::user();
            if($user->type == 'A'){
                Session::put('is_Admin', True);
            }
        }
        else{
            Session::put('is_login', False);
            Session::put('is_Admin', False);
            // session()->forget('success');
            // session()->flush();
        }
        return $next($request);
    }
}
