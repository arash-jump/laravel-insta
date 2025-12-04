<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfirmRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->check()){
            return redirect()->route('login');
        }
        
        if(auth()->user()->role_id !== 1) {
            return redirect('/')->with('error', 'Only Admin can enter into this page.');
        }
        return $next($request);
    }
}
