<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Requisition extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'store_id',
        'status',
        'notes',
        'requested_by',
        'approved_by',
        'approved_at',
    ];

    // Relationships
    public function items()
    {
        return $this->hasMany(RequisitionItem::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
