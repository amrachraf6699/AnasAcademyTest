<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log the incoming request
        \Log::info("Incoming request to /{$request->path()}, using {$request->method()} method. IP: {$request->ip()}, User-Agent: {$request->header('User-Agent')}");

        return $next($request);
    }
}
