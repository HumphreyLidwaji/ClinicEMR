<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Baby extends Model implements AuditableContract
{
      use Auditable;
   protected $fillable = [
    'delivery_id',
    'birth_weight',
    'apgar_score',
    'status',
    'patient_id',
];


    public function delivery() {
        return $this->belongsTo(Delivery::class);
    }
    public function patient()
{
    return $this->belongsTo(Patient::class);
}

}
