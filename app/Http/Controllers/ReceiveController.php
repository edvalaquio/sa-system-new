<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReceiveController extends Controller
{
    public function index(){
        $received = Transaction::join('transact', 'transaction_id', '=', 'transactions.id')
            ->leftjoin('users', 'users.id', '=', 'sender_id')
            ->where('receiver_id', '=', Auth::user()->id)
            ->select('*', 'transact.created_at', 'transactions.status' , 'transact.created_at as date')
            ->get();
        // return $received;
        // return view('received', compact('received'));
        return json_encode($received);
    }

    public function createReceive(Request $request){

        $document = 0;
        if ($request->file){
            $document = 1;
        }
        // Create new row in Transaction Table
        $transaction = Transaction::create([
            'title' => $request->title,
            'has_documents' => $document,
            'comment' => "None",
            'description' => $request->description,
            'status' => "pending",
        ]);

        DB::table('transact')->insert([
            'transaction_id' => $transaction->id,
            'sender_id' => null,
            'receiver_id' => Auth::user()->id,
            'note' => "Recieved from: ".$request->recipient,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        return $request;
    }

    public function uploadReceive(Request $request){
        if(!$request->hasFile('file')){
            return "Fail";
        }
        $path = $path = $request->file->store('images');
        return $path;
        // return $request->data['description'];
    }

    public function search(Request $request){
        $sent = Transaction::join('transact', 'transaction_id', '=', 'transactions.id')
            ->leftjoin('users', 'users.id', '=', 'sender_id')
            ->where('receiver_id', '=', Auth::user()->id)
            ->where('transactions.description', '=', "*".$request->keyword."*")
            ->orWhere('transactions.title', '=', "*".$request->keyword."*")
            ->select('*', 'transact.created_at', 'transactions.status', 'transact.created_at as date')
            ->get();
        // return $received;
        // return view('sent', compact('sent'));
}
