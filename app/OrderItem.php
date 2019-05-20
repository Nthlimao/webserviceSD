<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
	use SoftDeletes;
	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['order_id', 'product_id', 'color_id', 'size_id', 'quantity' , 'price'];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color() {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function size() {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }    
}
