<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;
use App\Models\Rol;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();
        
        if (!$usuario) {
            $token = $request->bearerToken() ?: $request->header('Authorization') ?: $request->input('api_token');
            if ($token) {
                $usuario = Usuario::where('api_token', $token)->first();
            }
        }

        if ($usuario && $usuario->rol && $usuario->rol->nombre_rol === 'Administrador') {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'No tienes permisos de administrador'
            ], 403);
        }
    }
}
