<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotSenate
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
        // Periksa apakah pengguna memiliki peran 'Senate'
        if (!$request->user() || $request->user()->user_role !== 'Senate') {
            return redirect('/');
        }

        return $next($request);
    }
}
