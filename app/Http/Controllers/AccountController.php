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
            ->select('users.id' , 'username', 'email', 'name', 'status')
            ->get();
        return json_encode($admins);
    }

    public function getStaffs(){
        if(Auth::user()->)
        $staffs = Staff::join('users', 'users.id', '=', 'staffs.user_id')
            ->join('admins', 'admins.id', '=', 'staffs.admin_id')
            ->where('admins.group', '=', Auth::user()->getType->group)
            ->select('users.id' , 'username', 'email', 'name', 'status')
            ->get();
        return json_encode($staffs);
    }

    public function addAccount(Request $request){
        $type = "staff";
        if($request->type == 'admin'){
            $type = "admin";
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'gender' => $request->gender,
            'type' => $request->type,
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

    public function usersInGroup(Request $request){
        $group = "";
        if(Auth::user()->type == 'admin'){
            $group = Auth::user()->getType->group;
        }else{
            $group = Auth::user()->getType->getAdmin->group;
        }
        // return $group;
        $admins = User::join('admins', 'users.id', '=', 'admins.user_id')
            ->select('users.name as name', 'users.id as id')
            ->where('admins.group', '=', $group)
            ->where('name', 'LIKE', '%'.$request->keyword.'%')
            ->get();
        $staffs = User::join('staffs', 'users.id', '=', 'staffs.user_id')
            ->select('users.name as name', 'users.id as id')
            ->join('admins', 'admins.id', '=', 'staffs.admin_id')
            ->where('admins.group', '=', $group)
            ->where('name', 'LIKE', '%'.$request->keyword.'%')
            ->get();
        $users = [];
        foreach ($admins as $admin) {
            $users[] = ['name' => $admin->name, 'id'=>$admin->id];
        }
        foreach ($staffs as $staff) {
            $users[] = ['name' => $staff->name, 'id'=>$staff->id];
        }

        return json_encode($users);
    }

    public function deleteAccount(Request $request){
        $userId = $request->userId;
        $user = User::find($userId);
        $user->status = 'deleted';
        $user->save();
    }

    public function recoverAccount(Request $request){
        $userId = $request->userId;
        $user = User::find($userId);
        $user->status = 'ok';
        $user->save();
    }
}
