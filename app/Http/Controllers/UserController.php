<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	$users = User::all();
        
        return $this->success($users);
    }

    public function show($id){
    	$user = User::find($id);

        if ($user) {
            return $this->success($user);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Usuário inválido.');
        }
    }

    public function store(Request $request){
    	$user = new User();

		$rules 	   = $user->rules();
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

        return $this->success($user);
    }

    public function update(Request $request, $id){
    	$user = User::find($id);

        if (!$user) {
            return $this->error(self::INVALID_RESOURCE, 'Usuário inválido.');
        }

        $email = $request->input('email');

        if(isset($email)){
            $dbUser = User::where('email', $email)->first();

            if($dbUser){
                return $this->error(self::VALIDATION_ERROR, 'O E-mail informado já está vinculado a um usuário');
            }
        }

        $user->fill($request->all());

        if($user->password) {
            $user->password = bcrypt($user->password);
        }

        if ($user->fullname) {
            $parts = explode(' ', $user->fullname);
            $user->shortname = $parts[0];
        }

        $user->save();

        return $this->success($user);
    }


    public function destroy($id){
    	$user = User::find($id);

        if ($user) {
            $user->delete();
            return $this->success('Usuário deletado com sucesso!');
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Usuário inválido.');
        }
    }
}