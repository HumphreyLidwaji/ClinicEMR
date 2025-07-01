<?php
// filepath: app/Models/ProcedureOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ProcedureOrder extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'procedure_id',
        'quantity',
        'price',
        'status',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}