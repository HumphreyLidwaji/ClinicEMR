<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class MaternityCase extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'patient_id', 'visit_id', 'lmp', 'edd', 'gravida', 'parity', 'notes'
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function visit() {
        return $this->belongsTo(Visit::class);
    }

    public function ancVisits() {
        return $this->hasMany(ANCVisit::class);
    }

    public function delivery() {
        return $this->hasOne(Delivery::class);
    }
    public function immunizationRecords()
{
    return $this->hasMany(ImmunizationRecord::class);
}
public function babies()
{
    return $this->hasManyThrough(Baby::class, Delivery::class);
}

}
