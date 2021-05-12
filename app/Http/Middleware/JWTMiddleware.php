<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;

use Closure;

class JWTMiddleware
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
        $message = "";
        try {
            JWTAuth::parseToken()->authenticate();
            return $next($request);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "Token expired";
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            $message = "Token invalid";
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $message = "provide token";
        }
        return response()->json([
            'success' => false,
            'message' => $message
        ]);
    }
}
