<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Roster extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['employee_id', 'shift_date', 'shift'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
