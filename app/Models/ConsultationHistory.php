<?php
// app/Models/ConsultationHistory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;     
class ConsultationHistory extends Model implements AuditableContract
{ 
    use Auditable;
    protected $fillable = [
        'visit_id',
        'past_history',
        'general_examination',
        'investigation',
        'user_id',
    ];
}
