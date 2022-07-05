<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use auth;

class Receptionist
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
        if(Auth::user()->role->name=="receptionist"){
            return $next($request);
        }
        elseif(Auth::user()->role->name=="doctor"){
            return $next($request);
        }
        return redirect()->back();
    }
}
