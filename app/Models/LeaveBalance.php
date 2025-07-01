<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class LeaveBalance extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['employee_id', 'leave_type', 'entitled_days', 'used_days'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getRemainingDaysAttribute()
    {
        return $this->entitled_days - $this->used_days;
    }
}
