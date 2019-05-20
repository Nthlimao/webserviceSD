<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPhoto extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['photo_url', 'product_id'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
}
