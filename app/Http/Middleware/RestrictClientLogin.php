<?php

namespace App\Http\Middleware;

use Closure;

class RestrictClientLogin
{
    public function handle($request, Closure $next)
    {
        // Obtener el usuario autenticado
        $user = $request->user();

        // Verificar si el usuario tiene un correo restringido para el inicio de sesión
        if ($user && $user->email === 'char2296@hotmail.com') {
            return response()->json(['error' => 'Acceso no autorizado'], 401);
        }

        return $next($request);
    }
}
