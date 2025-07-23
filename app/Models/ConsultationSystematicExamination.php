<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;     

   
class ConsultationSystematicExamination extends Model implements AuditableContract
{
     use Auditable;
    protected $fillable = [
        'visit_id',
        'systematic_examination_id',
        'user_id',
    ];

    public function systematicExamination()
{
    return $this->belongsTo(\App\Models\SystematicExamination::class, 'systematic_examination_id');
}

}
