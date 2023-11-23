<?php

namespace App\Http\Middleware;

use Closure;

class AdminUser
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
        $user = $request->user();


        if ($user && $user->role === 'admin') {
            return response()->json(['error' => 'Acceso no autorizado'], 401);
        }

        return $next($request);
    }
}
