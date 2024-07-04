<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotGuest
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
        // Periksa apakah pengguna memiliki peran 'Guest'
        if (!$request->user() || $request->user()->role !== 'Guest') {
            return redirect('/');
        }

        return $next($request);
    }
}
