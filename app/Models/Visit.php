<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class Visit extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'type',
        'department_id', 
        'visit_number',
        'start_date',
        'is_active',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

      public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function vitals()
{
    return $this->hasMany(\App\Models\Vital::class);
}
public function labOrders()
{
    return $this->hasMany(\App\Models\LabOrder::class);
}

public function radiologyOrders()
{
    return $this->hasMany(\App\Models\RadiologyOrder::class);
}

public function serviceOrders()
{
    return $this->hasMany(\App\Models\ServiceOrder::class);
}

public function procedureOrders()
{
    return $this->hasMany(\App\Models\ProcedureOrder::class);
}

public function invoice()
{
    return $this->hasOne(\App\Models\Billing\Invoice::class);
}
public function consultation()
{
    return $this->hasOne(\App\Models\Consultation::class);
}
public function medications()
{
    return $this->hasMany(\App\Models\Medication::class);
}

public function latestVitals()
{
    return $this->hasOne(\App\Models\Vital::class)->latestOfMany();
}
public function prescriptions()
{
    return $this->hasMany(Prescription::class);
}


}