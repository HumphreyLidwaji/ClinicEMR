<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class DischargeSummary extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'visit_id',
        'discharge_date',
        'summary',
        'outcome',
        'referral_note',
        'death_note',
           'icd11_id',
    'attending_doctor_id',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function doctor()
{
    return $this->belongsTo(User::class, 'attending_doctor_id');
}

public function icd11()
{
    return $this->belongsTo(Icd11::class);
}


}
