<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Delivery extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'maternity_case_id', 'visit_id', 'delivery_date',
        'delivery_type', 'complications'
    ];
    protected $casts = [
    'delivery_date' => 'datetime',
];

    public function maternityCase() {
        return $this->belongsTo(MaternityCase::class);
    }

    public function visit() {
        return $this->belongsTo(Visit::class);
    }

    public function babies() {
        return $this->hasMany(Baby::class);
    }

    
}
