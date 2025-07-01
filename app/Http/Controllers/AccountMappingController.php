<?php
namespace App\Http\Controllers;

use App\Models\AccountMapping;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountMappingController extends Controller
{
    public function index()
    {
        $mappings = AccountMapping::with('account')->paginate(20);
        return view('account_mappings.index', compact('mappings'));
    }

    public function create()
    {
        $accounts = Account::all();
        return view('account_mappings.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'entity_type' => 'required|string',
            'entity_id' => 'required|integer',
            'account_id' => 'required|exists:accounts,id',
        ]);
        AccountMapping::updateOrCreate(
            [
                'entity_type' => $request->entity_type,
                'entity_id' => $request->entity_id,
            ],
            [
                'account_id' => $request->account_id,
            ]
        );
        return redirect()->route('account-mappings.index')->with('success', 'Mapping saved.');
    }
    public function edit($id)
    {
        $mapping = AccountMapping::findOrFail($id);
        $accounts = Account::all();
        return view('account_mappings.edit', compact('mapping', 'accounts'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'entity_type' => 'required|string',
            'entity_id' => 'required|integer',
            'account_id' => 'required|exists:accounts,id',
        ]);
        $mapping = AccountMapping::findOrFail($id);
        $mapping->update($request->all());
        return redirect()->route('account-mappings.index')->with('success', 'Mapping updated.');
    }

    public function destroy($id)
    {
        $mapping = AccountMapping::findOrFail($id);
        $mapping->delete();
        return redirect()->route('account-mappings.index')->with('success', 'Mapping deleted.');
    }

    public function show($id)
    {
        $mapping = AccountMapping::with('account')->findOrFail($id);
        return view('account_mappings.show', compact('mapping'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $mappings = AccountMapping::with('account')
            ->where('entity_type', 'like', "%{$query}%")
            ->orWhereHas('account', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->paginate(20);
        return view('account_mappings.index', compact('mappings'));
    }
}