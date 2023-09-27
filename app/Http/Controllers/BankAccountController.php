<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    public function get()
    {
        return response()->json([
            'bank_accounts' => BankAccount::select(['bank_accounts.*', 'banks.name'])
            ->join('banks', 'banks.id', '=', 'bank_accounts.bank_id')
            ->where('user_id', Auth::user()->id)->get()
        ]);
    }
}
