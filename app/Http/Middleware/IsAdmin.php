<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){

        $auth_email = auth()->user()->email;
        $email      = "admin@grtech.com.my";
        
        if ($auth_email != $email) {
            return abort('403');
        }

        return $next($request);
    }
}
