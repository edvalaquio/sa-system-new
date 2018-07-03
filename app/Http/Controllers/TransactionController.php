<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request, $id){
        $transacts= Transaction::select('title', 'description', 'note', 'transactions.status', 'has_documents', 'transact.created_at as date')
            ->join('transact', 'transaction_id', '=', 'transactions.id')
            ->where('transaction_id', '=', $id)
            ->leftJoin('users as receiver', 'receiver_id', '=', 'receiver.id')
            ->leftJoin('users as sender', 'sender_id', '=', 'sender.id')
            ->get();
        return json_encode($transacts);
    }

    public function autocompleteRecipient(Request $request){
        
    }

}
