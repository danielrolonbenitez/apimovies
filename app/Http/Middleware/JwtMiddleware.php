<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\ApiTrait;

class JwtMiddleware
{
    use ApiTrait;
    public function handle($request, Closure $next)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                $data = (object)array("message" => "your token is Invalid");
                return response()->json($this->formatDate($data, '422'));
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $data = (object)array("message" => "your token is expired");
                return response()->json($this->formatDate($data, '422'));
            } else {
                $data = (object)array("message" => "autorization token is not found");
                return response()->json($this->formatDate($data, '422'));
            }
        }
        return $next($request);
    }
}
