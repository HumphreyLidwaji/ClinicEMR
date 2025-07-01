<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Medication extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;


// Add these fields to $fillable:
protected $fillable = [
    'visit_id',
    'drug_id',
    'dosage_id',
    'route_id',
    'medications',
];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
    public function dosage()
    {
        return $this->belongsTo(Dosage::class);
    }
    public function route()
    {
        return $this->belongsTo(RouteModel::class); // Use a different name if 'Route' conflicts with Laravel's Route facade
    }
}