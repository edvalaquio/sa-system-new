<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTags(){
        $tags = Tag::all();
        return json_encode($tags);
    }
}
