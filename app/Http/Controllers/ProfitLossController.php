<?php
namespace App\Http\Controllers;

use App\Models\Account;

class ProfitLossController extends Controller
{
    public function index()
    {
        $incomeAccounts = Account::where('type', 'income')->with('transactions')->get();
        $expenseAccounts = Account::where('type', 'expense')->with('transactions')->get();
        return view('accounts.profitloss.index', compact('incomeAccounts', 'expenseAccounts'));
    }
}