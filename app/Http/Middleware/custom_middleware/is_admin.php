<?php

namespace App\Http\Middleware\custom_middleware;

use Closure;
use Illuminate\Http\Request;
use session;

class is_admin
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
        if(Session()->get('user_type') != 'admin'){
            return response()->view('noaccess');
        }
        
        return $next($request);
    }
}
