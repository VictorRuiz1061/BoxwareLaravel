<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $token = $request->bearerToken() ?: $request->header('Authorization') ?: $request->input('api_token');
        
        if (!$token) {
            return response()->json([
                'message' => 'Token no proporcionado'
            ], 401);
        }
        
        $usuario = Usuario::where('api_token', $token)->first();
        
        if ($usuario) {
            // Adjuntar el usuario a la solicitud para usarlo posteriormente
            $request->setUserResolver(function () use ($usuario) {
                return $usuario;
            });
            return $next($request);
        }

        return response()->json([
            'message' => 'No autorizado'
        ], 401);
    }
}
