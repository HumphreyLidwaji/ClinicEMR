<?php
namespace App\Exports;

use OwenIt\Auditing\Models\Audit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuditLogsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Audit::with('user')->latest()->get()->map(function ($audit) {
            return [
                'User' => optional($audit->user)->name ?? 'System',
                'Model' => class_basename($audit->auditable_type),
                'Event' => $audit->event,
                'Old Values' => json_encode($audit->old_values),
                'New Values' => json_encode($audit->new_values),
                'Date' => $audit->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return ['User', 'Model', 'Event', 'Old Values', 'New Values', 'Date'];
    }
}
