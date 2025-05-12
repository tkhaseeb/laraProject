<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->is_admin == 0){
            //return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
            return abort(403, 'Unauthorized action.');
        }
        
        
        return $next($request);
    }
}
