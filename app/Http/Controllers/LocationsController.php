<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

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


        if (is_string($id) && !ctype_digit($id)) {
            $query = City::join('states', 'states.id', 'state_id')
                ->where('states.abbrv', $id)
                ->select('cities.*');
            $search = $request->input('q', null);
            if (!empty($search)) {
                $query->where('cities.name', 'like', "%{$search}%")
                    ->limit(10);
            }
            $cities = $query->get();
        } else {
            $cities = City::where(['state_id' => $id])->get();
        }
        if ($cities) {
            return $this->success($cities);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Cidades Indisponiveis');
        }        
    }
}
