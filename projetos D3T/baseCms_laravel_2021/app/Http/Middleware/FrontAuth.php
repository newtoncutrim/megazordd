<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontAuth
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
        if (isset($_COOKIE['TKNjwt'])) {
            $request->headers->set('Authorization', 'Bearer ' . $_COOKIE['TKNjwt']);
        }

        return $next($request);
    }
}
