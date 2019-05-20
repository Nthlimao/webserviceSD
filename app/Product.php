<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
    	'name',
    	'description',
    	'category_id',
    	'featured_photo_url',
    	'permanent_link',
    	'price',
    	'color',
    	'quantity',
    	'reference',
    	'featured'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function photos() {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }

    public function colors() {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function sizes() {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function rules() {
        return [
            'name'               => 'required',
            'category_id'        => 'required',
            'featured_photo_url' => 'required',
            'price'              => 'required',
            'quantity'           => 'required'
        ];
    }

    public function messages() {
        return [          
            'name.required'               => 'Por favor, insira o nome do produto',
            'category_id.required'        => 'Por favor, selecione a categoria do produto ',
            'featured_photo_url.required' => 'Por favor, insira a foto de destaque do produto',
            'price.required'              => 'Por favor, insira o preço do produto',
            'quantity.required'           => 'Por favor, insira a quantidade do produto'
        ];
    }
}
