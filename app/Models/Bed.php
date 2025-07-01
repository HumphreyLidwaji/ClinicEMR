<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Bed extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['ward_id', 'name', 'charge', 'status'];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}