<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class RequisitionItem extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'item_id',
        'quantity',
        'remarks',
    ];

    // Relationships
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
