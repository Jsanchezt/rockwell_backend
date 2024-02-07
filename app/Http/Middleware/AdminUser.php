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


        if ($user && $user->role !== 'admin' && $user->role !== 'hair') {
            return response()->json(['error' => 'Acceso no autorizado'], 500);
        }

        return $next($request);
    }
}
