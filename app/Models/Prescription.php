<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Prescription extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'visit_id',
        'drug_id',
        'dosage_id',
        'route_id',
        'duration',
        'quantity',
        'is_discharge_med',
        'dispensed', // Make sure to include this if you're using it
    ];

    // Relationships

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }



public function dosage()
{
    return $this->belongsTo(Dosage::class);
}




public function route()
{
    return $this->belongsTo(RouteModel::class, 'route_id');
}





}
