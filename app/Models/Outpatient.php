<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Outpatient extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'visit_date',
        'status',
        'visit_date',
    'created_at',
    'updated_at',
    ];
protected $casts = [
    'visit_date' => 'date',
];

    // Relation to Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relation to Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
