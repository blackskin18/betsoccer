<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( $request->user()->level != 1){
        return Redirect::to('user/list-match');
        }
        return $next($request);
    }
}
