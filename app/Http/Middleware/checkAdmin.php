<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        // return redirect(route('merchandise_home'));
        // return redirect(route('trade'));
        if(Auth::check())
        {
            $user = Auth::user();
            if( $user->type != 'A') 
            {
                return redirect(route('merchandise_home'));
            }
        }
        else
        {
            return redirect(route('merchandise_home'));
        }

        return $next($request);
    }
}
