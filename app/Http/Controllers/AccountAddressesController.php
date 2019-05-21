<?php

namespace App\Http\Controllers;

use Validator;
use App\Address;
use Illuminate\Http\Request;

class AccountAddressesController extends Controller
{
    public function index(){
    	$user = $this->user();
    	$adresses = Address::with(['city', 'state'])->where('user_id', $user->id)->get();
    	return $this->success($adresses);
    }

    public function show($id){
    	$user = $this->user();
        $address = Address::with(['city', 'state'])->where('user_id', $user->id)->find($id);

        if ($address) {
            return $this->success($address);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Endereço inválido.');
        }
    }

    public function store(Request $request){
    	$address = new Address();
    	$user 	 = $this->user();

		$rules 	   = $address->rules();
		$messages  = $address->messages();
		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
			return $this->error(self::VALIDATION_ERROR, $validator->errors()->first());		
		}

		$address->fill($request->all());
        $address->user_id = $user->id;
        $address->save();

        return $this->success($address);
    }

    public function update(Request $request, $id){
    	$user = $this->user();
    	$address = Address::where('user_id', $user->id)->find($id);

    	if ($address) {
            $address->fill($request->all());
            $address->save();

            return $this->success($address);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Endereço inválido.');
        }
    }

    public function destroy($id){
    	$user = $this->user();
        $address = Address::where('user_id', $user->id)->find($id);

        if ($address) {
            $address->delete();
            return $this->success();
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Endereço inválido.');
        }
    }
}
