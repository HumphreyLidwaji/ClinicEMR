<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Appointment extends Model implements AuditableContract
{
      use Auditable;
protected $fillable = [
    'patient_id', 'doctor_id', 'date', 'time', 'status', 'appointment_number'
];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

                        
}