<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Billing extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'services',
        'total',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}