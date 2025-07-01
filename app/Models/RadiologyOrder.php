<?php
// filepath: app/Models/RadiologyOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class RadiologyOrder extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'radiology_id',
        'quantity',
        'price',
        'status',
    ];

     public function imagingTest()
    {
        return $this->belongsTo(RadiologyOrder::class);
    }
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function radiologyService()
    {
        return $this->belongsTo(RadiologyService::class);
    }

    public function results()
    {
        return $this->hasMany(RadiologyResult::class);
    }

    
}