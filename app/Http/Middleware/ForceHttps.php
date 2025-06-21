<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */    public function handle(Request $request, Closure $next)
    {
        // Check if we're in production and not already secure
        if (app()->environment('production')) {
            // Check various headers that indicate HTTPS from load balancer
            $isSecure = $request->isSecure() || 
                       $request->header('X-Forwarded-Proto') === 'https' ||
                       $request->header('X-Forwarded-SSL') === 'on' ||
                       $request->header('X-Forwarded-Port') === '443';
            
            if (!$isSecure) {
                return redirect()->secure($request->getRequestUri(), 301);
            }
        }

        return $next($request);
    }
}
