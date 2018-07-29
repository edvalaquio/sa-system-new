<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date)
    {

        $transactions = Transaction::join('transact as t2', 't2.transaction_id', '=', 'transactions.id')
        ->select('transactions.id as transaction_id', 't2.id as id', 't2.note', 't2.created_at as date', 'transactions.title', 'transactions.comment', 'transactions.description', 'transactions.status', 'transactions.has_documents', 'sender_id', 'receiver_id')
        ->where(function($q){
            $q->where('sender_id', Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id);
        })
        ->whereDate('t2.created_at', Carbon::parse($date))
        ->orderBy('date', 'desc')
        ->get();

        foreach ($transactions as $key => $value) {
            if($value->sender_id == Auth::user()->id){
                $value['type'] = "Sent";
            }
            if($value->receiver_id == Auth::user()->id){
                $value['type'] = "Received";
            }
            $transactions[$key] = $value;
        }
        // $transactions = DB::table('transact')
        // ->join('transactions', 'transaction_id', '=', 'transact.id')
        // ->get();
        return json_encode($transactions);
        // return $transactions;
    }


    public function transactionAt($date){

    }

    public function getUserID(){
        return Auth::user()->id;
    }

}
