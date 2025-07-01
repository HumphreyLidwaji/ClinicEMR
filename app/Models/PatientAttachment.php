<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class PatientAttachment extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'file_path',
        'description',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}