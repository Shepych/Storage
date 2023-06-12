<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(env('API_KEY') != $request->api_key) {
            return response()->json([
                'success' => false,
                'message' => 'Неверный API ключ'
            ]);
        }
        
        return $next($request);
    }
}
