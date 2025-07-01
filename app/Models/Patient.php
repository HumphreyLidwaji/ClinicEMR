<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Patient extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

   protected $fillable = [
    'first_name', 'last_name', 'dob','patient_no', 'id_number', 'gender', 'phone', 'email',
    'guardian_name', 'guardian_relationship', 'guardian_phone', 'guardian_email',
    'county_id', 'subcounty_id', 'ward_id',
];


    // Optional: define relationships
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'appointments');
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
public function county()
{
    return $this->belongsTo(County::class, 'county_id');
}

public function subcounty()
{
    return $this->belongsTo(Subcounty::class, 'subcounty_id');
}

// Change this to SubCountyWard relation
public function ward()
{
    return $this->belongsTo(SubCountyWard::class, 'ward_id');
}
 public function visits()
{
    return $this->hasMany(\App\Models\Visit::class);
}
public function invoices()
{
    return $this->hasMany(\App\Models\Billing\Invoice::class);
}
public function latestVisit()
{
    return $this->hasOne(\App\Models\Visit::class)->latestOfMany();
}

public function immunizationRecords()
{
    return $this->hasMany(ImmunizationRecord::class);
}


    
}