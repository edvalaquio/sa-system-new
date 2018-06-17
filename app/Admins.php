<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $fillable = [
        'user_id', 'group',
    ];

    public function getUser(){
        return $this->hasOne('App\User');
    }
}
