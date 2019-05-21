<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use JWTAuth;

class IsAdmin
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
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        
        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        return response()
            ->json([
                'status' => 'ERROR',
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Você não possui a permissão necessária para acessar o recurso solicitado.'
                ],
            ], 403);
    }
}
