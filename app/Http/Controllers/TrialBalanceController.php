<?php
namespace App\Http\Controllers;

use App\Models\Account;

class TrialBalanceController extends Controller
{
    public function index()
    {
        $accounts = Account::with('transactions')->get();
        return view('accounts.trialbalance.index', compact('accounts'));
    }
}