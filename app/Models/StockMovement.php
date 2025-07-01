<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class StockMovement extends Model implements AuditableContract
{
      use Auditable;
 protected $fillable = [
    'drug_id',
    'quantity',
    'reason',
    'reference_id',
    'reference_type',
];
}
