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

    public function register(Request $request) {
        $user = new User();

        $rules     = $user->rules();
        $messages  = $user->messages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->error(self::VALIDATION_ERROR, $validator->errors()->first());     
        }

        $email = $request->input('email');

        if(isset($email)){
            $dbUser = User::where('email', $email)->first();

            if($dbUser){
                return $this->error(self::VALIDATION_ERROR, 'O E-mail informado já está vinculado a um usuário');
            }
        }

        $user->fill($request->all());
        $user->password = bcrypt($user->password);

        if ($user->fullname) {
            $parts = explode(' ', $user->fullname);
            $user->shortname = $parts[0];
        }

        $user->save();
        $token = JWTAuth::fromUser($user);
        JWTAuth::setToken($token);
        
        return $this->success([
            'token' => $token,
            'user' => JWTAuth::toUser($token)
        ]);
    }
}
