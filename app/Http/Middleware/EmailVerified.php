<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Support\Facades\Auth;

class EmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() !== null && !Auth::user()->email_verified) {
            $response = ["code"   => 422,
                         "errors" => ["email_verified" => ["Please verify your email address before interacting with the API"]]
            ];
            return response()->json($response, 422);
        }
        return $next($request);
    }
}
