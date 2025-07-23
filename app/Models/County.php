<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class County extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['county_name'];

    public function subcounties()
    {
        return $this->hasMany(Subcounty::class);
    }
}
