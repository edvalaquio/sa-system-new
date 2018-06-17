<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'username', 'type', 'gender', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getType(){
        if($this->type == 'admin'){
            return $this->hasOne('App\Admin');
        }
        elseif ($this->type == 'staff') {
            return $this->hasOne('App\Staff');
        }
    }

    // public function received(){
    //     return $this->belongsToMany('App\Transaction', 'receiver_id', 'transaction_id')->using('App\Transact')->as('transact');
    // }
    //
    // public function sent(){
    //     return $this->belongsToMany('App\Transaction', 'transact', 'sender_id', 'transaction_id')->using('App\Transact');
    // }
}
