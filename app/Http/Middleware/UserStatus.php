<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserStatus
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
        //dd(Auth::user()->status == 'Approved');
        if (Auth::user() !== null && Auth::user()->status !== 'active') {
            $response = [
                "code"   => 422,
                "errors" => ["status" => ["Your account is still being reviewed. Please try again in 24 hours."]]
            ];
            return response()->json($response, 422);
        }
        return $next($request);
    }
}
