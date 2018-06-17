<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';

    protected $fillable = [
        'user_id', 'admin_id',
    ];

    public function getUser(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
