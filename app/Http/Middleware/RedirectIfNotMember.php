<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotMember
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
        // Periksa apakah pengguna memiliki peran 'Member'
        if (!$request->user() || $request->user()->user_role !== 'Member') {
            return redirect('/');
        }

        return $next($request);
    }
}
