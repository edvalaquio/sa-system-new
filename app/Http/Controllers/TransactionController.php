<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request, $id){
        $transacts= Transaction::join('transact', 'transaction_id', '=', 'transactions.id')
            ->where('transaction_id', '=', $id)
            ->leftJoin('users', 'receiver_id', '=', 'users.id')
            ->leftJoin('users as users1', 'sender_id', '=', 'users1.id')
            ->get();
        return view('transaction', compact('transacts'));
    }

}
