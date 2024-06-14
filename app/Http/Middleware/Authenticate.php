<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

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
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->auth->guard()->guest()) {
            return response('Unauthorized.', 401);
        }

        if ($request->has('logout')) {
            try {
                JWTAuth::parseToken()->invalidate();
                return response()->json(['message' => 'Successfully logged out']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to logout'], 500);
            }
        }

        return $next($request);
    }
}