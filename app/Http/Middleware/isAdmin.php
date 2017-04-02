<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class isAdmin
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
        if(Auth::check() && Auth::user()->user_level_id == '1') {
            return $next($request);
        }
        Auth::logout();
        return Redirect::to('login')->with('pesanwarning', 'Akses Admin diperlukan.');
    }
}

