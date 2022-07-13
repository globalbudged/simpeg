<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheResponseMidleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Cache::flush();
        $method = $request->method();
        $key = 'request|'.$request->url().'|'.$request->user()->id;
        if ($method === 'GET') {
            // return response()->json($key);
            return Cache::remember($key, now()->addDay(), function () use ($next, $request) {
                return $next($request);
            });
        } else {
            Cache::flush();
            return $next($request);
        }
        

        // return $next($request);
    }
}
