<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class RadiologyService extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    public function results()
    {
        return $this->hasMany(RadiologyResult::class);
    }           

                                                                                        
}