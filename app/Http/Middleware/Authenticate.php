<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure; // Ensure this use statement is present

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!$request->bearerToken()&&$request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated: No token provided'], 401);
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     */
    protected function unauthenticated($request, array $guards)
    {
        // Check if the request expects JSON
        if ($request->expectsJson()) {
            abort(response()->json(['error' => 'Unauthenticated: Invalid token'], 401));
        } else {
            // Redirect if not an API request
            abort(redirect()->route('login'));
        }
        // abort(response()->json(['error' => 'Unauthenticated: Invalid token'], 401));
    }
}
