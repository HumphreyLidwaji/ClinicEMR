<?php

namespace App\Models\Laboratory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient\Patient;

class LabRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'test_name',
        'date_requested',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
}