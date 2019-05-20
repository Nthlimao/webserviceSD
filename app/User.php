<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['fullname', 'shortname', 'email', 'phone', 'birthday', 'role'];
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    public const ADMIN = 'ADMIN';
    public const CLIENT = 'CLIENT';
    public const DELIVERYMAN = 'DELIVERYMAN';

    public function addresses() {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function rules() {
        return [
            'fullname'      => 'required',
            'email'         => 'required|email',            
            'password'      => 'required|min:6',
            'conf_password' => 'required_with:password|same:password'
        ];
    }

    public function messages() {
        return [          
            'fullname.required'  => 'Por favor, insira o seu nome completo',
            'email.required'     => 'Por favor, insira o seu email',
            'email.email'        => 'E-mail inválido',            
            'password.required'  => 'Por favor, insira sua senha',
            'password.min'       => 'A senha deve ter no mínimo 6 caracteres',
            'conf_password.same' => 'As senhas devem ser iguais'
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

}
