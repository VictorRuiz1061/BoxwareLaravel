<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Usuario;

class IsUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener el token del header Authorization
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token no proporcionado'
            ], 401);
        }
        
        // Buscar el token en la tabla de tokens personales de Sanctum
        $accessToken = PersonalAccessToken::findToken($token);
        
        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Token inválido'
            ], 401);
        }
        
        // Verificar si el token ha expirado
        if ($accessToken->expires_at && $accessToken->expires_at->isPast()) {
            return response()->json([
                'success' => false,
                'message' => 'Token expirado'
            ], 401);
        }
        
        // Obtener el usuario asociado al token
        $usuario = $accessToken->tokenable;
        
        if (!$usuario || !$usuario->estado) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autorizado o inactivo'
            ], 401);
        }
        
        // Adjuntar el usuario a la solicitud para usarlo posteriormente
        $request->setUserResolver(function () use ($usuario) {
            return $usuario;
        });
        
        return $next($request);
    }
}
