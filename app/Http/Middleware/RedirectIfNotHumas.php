<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotHumas
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
        // Periksa apakah pengguna memiliki peran 'Humas'
        if (!$request->user() || $request->user()->role !== 'Humas') {
            return redirect('/');
        }

        return $next($request);
    }
}
