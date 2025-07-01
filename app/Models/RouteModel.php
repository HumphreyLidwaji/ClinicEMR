<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class RouteModel extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $table = 'routes';
    protected $fillable = ['name'];
}