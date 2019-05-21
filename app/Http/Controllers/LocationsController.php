<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;

class LocationsController extends Controller
{
    public function states(){
    	$states = State::all();
        
        if ($states) {
            return $this->success($states);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Estados Indisponiveis');
        }
    }

    public function cities($id) {
        $cities = City::where('state_id', $id)->get();

        if ($cities) {
            return $this->success($cities);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Cidades Indisponiveis');
        }        
    }
}
