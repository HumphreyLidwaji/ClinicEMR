<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ImmunizationSchedule extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'vaccine_name',
        'dose_label',
        'recommended_age_weeks',
    ];

    public function records()
    {
        return $this->hasMany(ImmunizationRecord::class);
    }
}
