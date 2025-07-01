<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Payslip extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['payroll_id', 'earnings', 'deductions', 'notes', 'generated_at'];

    protected $casts = [
        'earnings' => 'array',
        'deductions' => 'array',
        'generated_at' => 'datetime',
    ];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    public function employee()
    {
        return $this->payroll->employee();
    }
}
