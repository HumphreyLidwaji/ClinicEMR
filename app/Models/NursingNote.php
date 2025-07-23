<?php

// app/Models/NursingNote.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NursingNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'shift',
        'nursing_date',
        'vitals',
        'interventions',
        'created_by',
    ];
}
