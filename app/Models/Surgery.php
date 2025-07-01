<?php

// app/Models/Surgery.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Surgery extends Model implements AuditableContract
{
      use Auditable;
protected $fillable = [
    'patient_name',
    'surgery_type',
    'status',
    'scheduled_at',
    'performed_at',
    'notes',
];


}
