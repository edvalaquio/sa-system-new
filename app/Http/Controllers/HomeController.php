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

        $transactions = DB::table('transact as t1')
        ->select('t1.id', 't1.note', 't1.created_at as date', 't2.title', 't2.comment', 't2.description', 't2.status', 't2.has_documents')
        ->join('transactions AS t2', 't1.transaction_id', '=', 't2.id')
        ->where(function($q){
            $q->where('sender_id', Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id);
        })
        ->whereDate('t1.created_at', Carbon::parse($date))
        ->get();
        // $transactions = DB::table('transact')
        // ->join('transactions', 'transaction_id', '=', 'transact.id')
        // ->get();
        return json_encode($transactions);
        // return $transactions;
    }

    public function singleTransaction($id){
        $transactions = DB::table('transact as t1')
        ->select('t1.id', 't1.note', 't2.created_at as date', 't2.title', 't2.comment', 't2.description', 't2.status', 't2.has_documents')
        ->join('transactions AS t2', 't1.transaction_id', '=', 't2.id')
        ->where('t1.transaction_id', '=', $id)
        ->get();

        return json_encode($transactions);
    }

    public function transactionAt($date){

    }

}
