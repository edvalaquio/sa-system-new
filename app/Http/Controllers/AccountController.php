<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Admin;
use App\Staff;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
        $staffs = Auth::user()->getType->getStaffs;
        $admins = Admin::all();
        return view('accounts', compact('staffs', 'admins'));
    }

    public function getAdmins(){
        $admins = Admin::join('users', 'users.id', '=', 'admins.user_id')
            ->get();
        return json_encode($admins);
    }

    public function getStaffs(){
        $staffs = Staff::join('users', 'users.id', '=', 'staffs.user_id')
            ->join('admins', 'admins.id', '=', 'staffs.admin_id')
            ->where('admins.group', '=', Auth::user()->getType->group)
            ->get();
        return json_encode($staffs);
    }

    public function addAccount(Request $request){
        $type = "staff";
        if($request->type == 'admin'){
            $type = "admin";
        }
        return $request->all();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'gender' => $request->gender,
            'type' => $type,
            'status' => "ok",
            'password' => Hash::make($request->password),
        ]);
        if($type == "admin"){
            Admin::create([
                'user_id' => $user->id,
                'group' => $request->group,
            ]);
        }elseif ($type == "staff") {
            Staff::create([
                'user_id' => $user->id,
                'admin_id' => Auth::user()->getType->id,
            ]);
        }
    }
}
