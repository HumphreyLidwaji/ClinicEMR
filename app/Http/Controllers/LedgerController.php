<?php
namespace App\Http\Controllers;

use App\Models\Account;

use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index()
    {
        $accounts = Account::with('transactions')->get();
        return view('accounts.ledgers.index', compact('accounts'));
    }
}