<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use App\Order;
use App\Address;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function view(){
    	return $this->success($this->user());
    }

    public function update(Request $request){
    	$data = $request->except(['shortname', 'role', 'password']);
    	$user = $this->user();
        $user->fill($data);
        $user->save();

        return $this->success($user);
    }
}
