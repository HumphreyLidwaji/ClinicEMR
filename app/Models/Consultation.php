<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Consultation extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

  
protected $fillable = [
    'visit_id',
    'notes',
    'past_history',
    'general_examination',
    'systematic_examination',
    'investigation',
    'diagnosis',
    'icd11_diagnosis',
    'treatment_plan',
];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function getFormattedNotesAttribute()
    {
        return nl2br(e($this->notes));
    }
    
}