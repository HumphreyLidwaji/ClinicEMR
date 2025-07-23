<?php
// app/Http/Controllers/Admin/AuditLogController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;
    use App\Exports\AuditLogsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $audits = Audit::with('user')
            ->when($request->event, fn($q) => $q->where('event', $request->event))
            ->when($request->model, fn($q) => $q->where('auditable_type', $request->model))
            ->latest()->paginate(20);

        return view('admin.audit_logs.index', compact('audits'));
    }


public function exportExcel()
{
    return Excel::download(new AuditLogsExport, 'audit-logs.xlsx');
}

public function exportPdf()
{
    $audits = \OwenIt\Auditing\Models\Audit::latest()->get();
    $pdf = Pdf::loadView('admin.audit_logs.pdf', compact('audits'));
    return $pdf->download('audit-logs.pdf');
}

}
