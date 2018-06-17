<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'comment', 'has_documents', 'title', 'description', 'status',
    ];

    // public function user(){
    //
    // }

}