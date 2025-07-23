<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Sale extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'sale_type',
        'visit_id',
        'drug_id',
        'quantity',
        'price',
        'total',
    ];

    public function drug()
{
    return $this->belongsTo(Drug::class);
}

}
