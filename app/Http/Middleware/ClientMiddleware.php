<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)//: Response
    {
       /* if (auth()->check() && auth()->user()->role === 'client') {
            return $next($request);
        }
    
        return redirect('/home'); // Redirect to home page or show an error page for unauthorized access.
    */
    }
}
