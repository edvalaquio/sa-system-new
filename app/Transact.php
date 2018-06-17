<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transact extends Model
{
    protected $table = 'transact';
    protected $fillable = [
        'sender_id', 'receiver_id', 'transaction_id', 'note',
    ];

    
}
