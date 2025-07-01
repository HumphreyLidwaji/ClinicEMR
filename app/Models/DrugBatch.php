<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class DrugBatch extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'drug_id', 'batch_number', 'expiry_date', 'quantity',
        'unit_price', 'source_type', 'source_id',
    ];

    public function drug() {
        return $this->belongsTo(Drug::class);
    }
}
