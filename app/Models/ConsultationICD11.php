<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;     


class ConsultationICD11 extends Model implements AuditableContract
{ 
    use Auditable;
    use HasFactory;
 protected $table = 'consultation_icd11s';
    protected $fillable = [
        'visit_id',
        'icd11_code_id',
        'user_id',
        // add other fields if needed
    ];

    public function icd11()
{
    return $this->belongsTo(\App\Models\Icd11::class, 'icd11_code_id');
}

}
