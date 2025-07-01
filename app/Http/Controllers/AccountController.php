<?php
namespace App\Http\Controllers;

use App\Models\Account;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'code' => 'required|unique:accounts,code',
            'account_balance' => 'required',
        ]);
        Account::create($request->all());
        return redirect()->route('accounts.index')->with('success', 'Account created.');
    }
}