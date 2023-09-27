<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Transactions extends Model
{
    public function approve(Request $request)
    {
        $validated = $request->validate([
            'trx_id' => ['required']
        ]);

        $transaction = Transactions::find($validated['trx_id']);
        $userId = $transaction->user_id;
        $transactionType = $transaction->type;
        $amount = $transaction->amount;

        $transaction->status = 'settled';
        $transaction->save();

        $user = User::find($userId);
        $user->balance = ($transactionType == 'credit') ? $user->balance += $amount : $user->balance -= $amount;
        $user->save();

        return response()->json([
            'code' => 0,
            'new_amt' => $user->balance
        ]);
    }

    public function history()
    {
        $transactions = Transactions::select([
            'transactions.*',
            'transaction_types.name AS transaction_type_name',
        ])
        ->join('transaction_types', 'transaction_types.id', '=', 'transactions.transaction_type_id')
        ->where('transactions.user_id', Auth::user()->id)->get();
        
        return response()->json([
            'data' => $transactions
        ]);
    }

    public function do_transaction(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required'],
            'transaction-type' => ['required'],
            'note' => []
        ]);

        $transaction = new Transactions();
        $transaction->user_id = Auth::user()->id;
        $transaction->transaction_type_id = $validated['transaction-type'];
        $transaction->amount = $validated['amount'];
        $transaction->type = (in_array($validated['transaction-type'], [3, 2])) ? 'credit' : 'debit';
        $transaction->va_number = (in_array($validated['transaction-type'], [3])) ? random_int(100000, 999999) : null;
        $transaction->save();

        return response()->json([
            'code' => 0
        ]);
    }
}
