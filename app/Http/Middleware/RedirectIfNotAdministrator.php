<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotAdministrator
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
        // Periksa apakah pengguna memiliki peran 'Administrator'
        if (!$request->user() || $request->user()->role !== 'Administrator') {
            return redirect('/');
        }

        return $next($request);
    }
}
