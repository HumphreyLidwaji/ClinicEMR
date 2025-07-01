<?php
// app/Http/Controllers/AuditLogController.php
namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')->latest()->paginate(30);
        return view('audit_logs.index', compact('logs'));
    }

    public function show($id)
    {
        $log = AuditLog::with('user')->findOrFail($id);
        return view('audit_logs.show', compact('log'));
    }

    
}