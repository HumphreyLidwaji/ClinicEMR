<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class SystematicExamination extends Model implements AuditableContract
{
      use Auditable;
    //
    // SystematicExamination.php
protected $fillable = ['name', 'system'];

}
