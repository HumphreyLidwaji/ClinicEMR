<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class Vital extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

protected $fillable = [
    'visit_id',
    'blood_pressure',
    'pulse',
    'temperature',
    'weight',
    'resp',
    'spo2',
    'rbs',
    'fbs',
];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}