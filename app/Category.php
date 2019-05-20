<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'name', 'description'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function products() {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function rules() {
        return [
            'name' => 'required',
        ];
    }

    public function messages() {
        return [          
            'name.required' => 'Por favor, insira o nome da categoria'
        ];
    }
    
}
