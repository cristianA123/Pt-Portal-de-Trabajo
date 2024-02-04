<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth ;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

use App\Modules\Shared\Traits\Responses;

class JwtMiddleware extends BaseMiddleware
{
    use Responses;

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->failure("Token invalido", 400, $request);

                // return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->failure("Token expiro", 400, $request);

                // return response()->json(['status' => 'Token is Expired']);
            }else{
                return $this->failure("Token no encontrado", 400, $request);
                // return response()->json([
                //         'success' => false,
                //         'message' => 'Token no encontrado'
                //     ]);
            }
        }
        return $next($request);
    }
}

