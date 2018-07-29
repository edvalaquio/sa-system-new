<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Transact;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendController extends Controller
{
    public function index(){
        $sent = Transaction::join('transact', 'transaction_id', '=', 'transactions.id')
            ->leftjoin('users', 'users.id', '=', 'receiver_id')
            ->where('sender_id', '=', Auth::user()->id)
            ->select('*', 'transact.created_at', 'transactions.status', 'transact.created_at as date')
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();
        // return $received;
        // return view('sent', compact('sent'));
        return json_encode($sent);
    }

    public function createSend(Request $request){
        $user = User::where('name', 'LIKE', $request->recipient)
            ->first();
        $inSystem = True;
        if(!$user){
            // Recipient outside the system
            $inSystem = False;
        }
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
        if(!$inSystem){
            DB::table('transact')->insert([
                'transaction_id' => $transaction->id,
                'sender_id' => Auth::user()->id,
                'receiver_id' => null,
                'note' => ("Sent to: ".$request->recipient),
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }else{
            DB::table('transact')->insert([
                'transaction_id' => $transaction->id,
                'sender_id' => Auth::user()->id,
                'receiver_id' => $user->id,
                'note' => ("Sent to: ".$request->recipient),
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        return $request;
    }

    public function uploadSend(Request $request){
        if(!$request->hasFile('file')){
            return "Fail";
        }
        // for testing purpose only, will modify later
        $path = $request->file('file')->storeAs('files');
        return $path;
        // return $request->data['description'];
    }

    public function sendTransaction(Request $request){
        $user = User::where('name', 'LIKE', $request->recipient)
            ->first();

        $transactionID = DB::table('transact as t')
            ->where('id' , '=', $request->transact_id)
            ->first()
            ->transaction_id;

        if($user){
            Transact::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $user->id,
                'note' => $request->note,
                'transaction_id' => $transactionID,
            ]);
        }
    }

    public function search(Request $request){
        $sent = Transaction::join('transact', 'transaction_id', '=', 'transactions.id')
            ->leftjoin('users', 'users.id', '=', 'receiver_id')
            ->where('sender_id', '=', Auth::user()->id)
            ->where(function($q) use ($request){
                $q->where('transactions.description', 'LIKE', "%".$request->keyword."%")
                ->orWhere('transactions.title', 'LIKE', "%".$request->keyword."%");
            })
            ->select('*', 'transactions.status', 'transact.created_at as date')
            ->take(10)
            ->orderBy('date', 'desc')
            ->get();
        // return $received;
        // return view('sent', compact('sent'));
        return json_encode($sent);
    }
}
