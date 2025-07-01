<?php
namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class LeaveType extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['name', 'description'];
}
