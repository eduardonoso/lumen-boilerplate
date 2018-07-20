<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $ignoreMiddleware = false;
        $ignoreRequests = [['method' => 'post', 'path' => 'account']];
        foreach ($ignoreRequests as $ignoreRequest){
            if($request->is('*/'.$ignoreRequest['path']) && strtolower($request->method()) == strtolower($ignoreRequest['method'])){
                $ignoreMiddleware = true;
            }
        }

        if (!$ignoreMiddleware && $this->auth->guard($guard)->guest()) {
            return response('Unauthorized', 401);
        }
        return $next($request);
    }
}
