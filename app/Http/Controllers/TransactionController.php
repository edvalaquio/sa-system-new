<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request, $id){
        $transactionID = DB::table('transact as t')
            ->where('id' , '=', $id)
            ->first()
            ->transaction_id;
        $transacts= Transaction::select('transaction_id', 'transact.id', 'title',
            'description', 'note', 'transactions.status', 'has_documents',
            'transact.created_at as date', 'sender_id', 'receiver_id',
            'receiver.name as receiver_name', 'sender.name as sender_name')
            ->join('transact', 'transaction_id', '=', 'transactions.id')
            ->where('transaction_id', '=', $transactionID)
            ->leftJoin('users as receiver', 'receiver_id', '=', 'receiver.id')
            ->leftJoin('users as sender', 'sender_id', '=', 'sender.id')
            ->get();
        foreach ($transacts as $key => $value) {
            if($value->sender_id == Auth::user()->id){
                $value['type'] = "Sent";
            }
            if($value->receiver_id == Auth::user()->id){
                $value['type'] = "Received";
            }
            $transacts[$key] = $value;
        }
        return json_encode($transacts);
    }

}
