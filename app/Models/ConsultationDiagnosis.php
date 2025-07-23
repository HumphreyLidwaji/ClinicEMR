<?php    
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ConsultationDiagnosis extends Model implements AuditableContract
{
  use Auditable;
  protected $table = 'consultation_diagnoses'; // Your actual table name
  protected $fillable = [
    'visit_id',
    'diagnosis_id',
    'user_id',
    'note',  // add this
];
public function diagnosis()
{
    return $this->belongsTo(\App\Models\ClinicalDiagnosis::class, 'diagnosis_id');
}

}
