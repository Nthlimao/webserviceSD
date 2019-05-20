<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
	use SoftDeletes;
    protected $dates  = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['order_id', 'deliveryman_id', 'tracking_code'];

    public function user() {
        return $this->belongsTo(User::class, 'deliveryman_id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    } 


}