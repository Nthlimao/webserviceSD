<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'name', 'initials'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function cities() {
        return $this->hasMany(City::class, 'state_id');
    }
}
