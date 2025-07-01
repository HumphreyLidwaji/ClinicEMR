<?php

namespace App\Models\SystemAdministration;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class DatabaseBackup extends Model implements AuditableContract
{
      use Auditable;
    //
 protected $fillable = [
    'file_name',
    'file_path',
    'created_at',
    'restore_status',
    'restored_at',
];

public $timestamps = false;

}
