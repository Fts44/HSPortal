<?php

namespace App\Http\Middleware\custom_middleware;

use Closure;
use Illuminate\Http\Request;
use session;

class auth_check
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
        if(!session()->has('userid_gsuite_email')){
            return redirect('noaccess');   
        }
        
        return $next($request);
     
    }
}
