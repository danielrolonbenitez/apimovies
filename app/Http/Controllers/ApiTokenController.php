<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;

use function Ramsey\Uuid\v1;

class ApiTokenController extends ApiController
{



   public function login(Request $request)
   {

      $credential = (array)$this->valiData($request->getContent());
      $validated = Validator::make($credential, [
         'email' => 'required|email',
         'password' => 'required',
      ]);


      if ($validated->fails()) {
         $data = array("message" => "Errror check email and password");
         $data = (object)$data;
         return $this->formatDate($data);
      }

      $token = JWTAuth::attempt($credential);
      JWTAuth::setToken($token);
      if ($token) {
         $data = array(
            "access_token" => $token,
            "type_token" => "bearer",
            "expired_token" => 60,
            "message" => "Success Login",
            "User" => User::where('email', $credential['email'])->get()->first()
         );
         $status = 200;
      } else {
         $data = array("message" => "Errror Login check crendentails");
         $status = 401;
      }

      $data = (object)$data;
      return $this->formatDate($data, $status);
   }



   public function refreshToken(Request $request)
   {
      $token = JWTAuth::refresh();
      JWTAuth::setToken($token);
      $data = (object)array("message" => "Success Refresh token", "token" => $token);
      return $this->formatDate($data);
   }
}
