<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Deduction extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['name', 'type', 'value', 'is_active'];

    public function getDisplayValueAttribute()
    {
        return $this->type === 'percentage' ? $this->value . '%' : 'KES ' . number_format($this->value, 2);
    }
}
