<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function transaction()
    {
        return view('main.transaction', [
            'transaction_types' => TransactionType::where('status', true)->get()
        ]);
    }

    public function history()
    {
        return view('main.transaction-history', [
            'user' => Auth::user()
        ]);
    }
}
