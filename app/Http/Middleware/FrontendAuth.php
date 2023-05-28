<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FrontendAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(Auth::check() && Auth::user()->role_as == '0') {
        if(Auth::check()) {
            $request->session()->regenerate();
            return $next($request);
        } else {
            return redirect('login')->with('noAccess', 'Please login first to use all features!');
        }
    }
}
