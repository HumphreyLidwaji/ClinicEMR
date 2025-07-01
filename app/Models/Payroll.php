<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Payroll extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'employee_id', 'pay_month', 'basic_salary', 'total_deductions', 'net_salary', 'processed_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
