<?php

namespace App\Http\Controllers;

use App\Address;
use Validator;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(){
    	$adresses = Address::with(['city', 'state'])->get();
        
        return $this->success($adresses);
    }

    public function show($id){
    	$address = Address::with(['city', 'state', 'user'])->find($id);

        if ($address) {
            return $this->success($address);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Endereço inválido');
        }
    }

    public function store(Request $request){
    	$address = new Address();

		$rules 	   = $address->rules();
		$messages  = $address->messages();
		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
			return $this->error(self::VALIDATION_ERROR, $validator->errors()->first());		
		}

		$address->fill($request->all());
		$address->save();
        return $this->success($address);
    }

    public function update(Request $request, $id){
    	$address = Address::find($id);

        if (!$address) {
            return $this->error(self::INVALID_RESOURCE, 'Endereço Inválido');
        }

        $address->fill($request->all());
        $address->save();
        return $this->success($address);
    }

    public function destroy($id){
    	$address = Address::find($id);

        if ($address) {
            $address->delete();
            return $this->success('Endereço deletado com sucesso!');
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Endereço inválido');
        }
    }
}
