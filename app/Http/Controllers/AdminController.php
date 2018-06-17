<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Staff;
use App\User;

class AdminController extends Controller
{
// will handle the initial landing page for admin user
    public function index(){
      return view('home');
    }

    // function for creating staff under an admin
    public function removeStaff($userid){
        $user = User::findOrFail($userid);
        $user->status = "deleted";
        $user->save();
        return true;
    }

    public function viewUser($userid){
        $user = User::find($user);

    }


}
