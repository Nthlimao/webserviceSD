<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
    	'street', 
    	'zipcode', 
    	'number', 
    	'complement', 
    	'neighborhood', 
    	'reference', 
    	'city_id', 
    	'state_id', 
    	'user_id'
    ]; 

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rules() {
        return [
            'street'       => 'required',
            'zipcode'      => 'required',
            'neighborhood' => 'required',
            'city_id'      => 'required',
            'state_id'     => 'required'
        ];
    }

    public function messages() {
        return [          
            'street.required'        => 'Por favor, insira o nome da rua',
            'zipcode.required'       => 'Por favor, insira o CEP',
            'neighborhood.required'  => 'Por favor, insira o Bairro',
            'state_id.required'      => 'Por favor, selecione o Estado',
            'city_id.required'       => 'Por favor, selecione a Cidade'
        ];
    }
}