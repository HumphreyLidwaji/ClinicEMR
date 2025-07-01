<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Leave extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'employee_id', 'leave_type', 'start_date', 'end_date', 'reason', 'status', 'approved_by', 'approved_at'
    ];

    protected function casts(): array
{
    return [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
