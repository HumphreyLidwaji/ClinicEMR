<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ANCVisit extends Model implements AuditableContract
{
    use Auditable;

    protected $table = 'anc_visits';

    protected $fillable = [
        'maternity_case_id',
        'visit_date',
        'weight',
        'bp_systolic',
        'bp_diastolic',
        'fetal_heart_rate',
        'notes',
    ];

    public function maternityCase()
    {
        return $this->belongsTo(MaternityCase::class);
    }
      public function visit() {
        return $this->belongsTo(Visit::class);
    }
}
