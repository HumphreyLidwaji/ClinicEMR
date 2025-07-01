<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Surgery;

class SurgeryPerformController extends Controller
{
    /**
     * Show surgeries that are scheduled and ready to perform.
     */
    public function index()
    {
        $surgeries = Surgery::where('status', 'scheduled')->get();
        return view('operation_theatre.perform.index', compact('surgeries'));
    }

    /**
     * Mark the selected surgery as performed.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $surgery = Surgery::findOrFail($id);
        $surgery->update([
            'status' => 'performed',
            'notes' => $request->notes,
            'performed_at' => now(),
        ]);

        return redirect()->route('surgery.perform')->with('success', 'Surgery marked as performed.');
    }
}
