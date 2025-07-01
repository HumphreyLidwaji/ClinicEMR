<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ClinicalDiagnosis extends Model implements AuditableContract
{
      use Auditable; //

// ClinicalDiagnosis.php
protected $fillable = ['name', 'category'];

}
