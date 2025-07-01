<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Icd11 extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'icd11_diagnosis', 'code');
    }

    
}