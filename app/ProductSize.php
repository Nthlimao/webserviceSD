<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
	use SoftDeletes;
    protected $fillable = ['id', 'name', 'product_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
