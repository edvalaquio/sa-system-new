<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'user_id', 'group',
    ];

    public function getUser(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getStaffs(){
        return $this->hasMany('App\Staff');
    }
}
