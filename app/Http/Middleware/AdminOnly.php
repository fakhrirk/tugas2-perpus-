<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
       if (auth()->check() && auth()->user()->email === 'fahribalap123@gmail.com') {
        return $next($request);
    }

    return redirect()->route('tamu.dashboard');
    }
}
    