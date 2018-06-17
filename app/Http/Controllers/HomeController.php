<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        // $transactions = Transaction::join('');
        $transactions = DB::table('transact')
        ->join('transactions', 'transaction_id', '=', 'transact.id')
        ->where('sender_id', Auth::user()->id)
        ->orWhere('receiver_id', Auth::user()->id)
        ->get();
        return json_encode($transactions);
        // return $transactions;
        return view('home', compact('transactions'));
    }

}
