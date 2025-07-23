<?php
// filepath: app/Models/LabOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class LabOrder extends Model implements AuditableContract
{
      use Auditable; use HasFactory;

    protected $fillable = [
        'visit_id',
        'lab_test_id',
        'quantity',
        'price',
        'status',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

public function labTest()
{
    return $this->belongsTo(\App\Models\LabTest::class, 'lab_test_id');
}


    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->price;
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    
}