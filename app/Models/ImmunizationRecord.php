<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ImmunizationRecord extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

 protected $fillable = [
    'patient_id',
    'immunization_schedule_id',
    'given_date',
    'is_given',
    'remarks',
    'maternity_case_id',
    'visit_id',
];


    protected $casts = [
        'is_given' => 'boolean',
        'given_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function schedule()
    {
        return $this->belongsTo(ImmunizationSchedule::class, 'immunization_schedule_id');
    }
    public function maternityCase()
{
    return $this->belongsTo(MaternityCase::class);
}

public function visit()
{
    return $this->belongsTo(Visit::class);
}

}



