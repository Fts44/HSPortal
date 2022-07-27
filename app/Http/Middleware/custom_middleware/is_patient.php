<?php

namespace App\Http\Middleware\custom_middleware;

use Closure;
use Illuminate\Http\Request;
use session;

class is_patient
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
        if(!Session()->has('user_type')){
            return view('noaccess');
        }

        if(!session()::get('user_type') == 'patient'){
            return view('noaccess');
        }

        return $next($request);
    }
}
