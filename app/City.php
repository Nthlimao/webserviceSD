<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'name', 'state_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }
}
