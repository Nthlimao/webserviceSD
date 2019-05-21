<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use JWTAuth;
use Validator;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);

        if ($token) {
            JWTAuth::setToken($token);
            $user = JWTAuth::toUser($token);
            
            return $this->success([
                'token' => $token,
                'user' => JWTAuth::toUser($token)
            ]);
        } else {
            return $this->error(self::INVALID_CREDENTIALS, 'Email e/ou senha inválidos.');
        }
    }
}
