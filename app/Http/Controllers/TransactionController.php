<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Account;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('account')->latest()->paginate(20);
        return view('accounts.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $accounts = Account::all();
        return view('accounts.transactions.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'date' => 'required|date',
            'type' => 'required|in:debit,credit',
            'amount' => 'required|numeric|min:0.01',
        ]);
        Transaction::create($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transaction added.');
    }
}