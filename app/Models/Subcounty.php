<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SubCountyWard;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Subcounty extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = ['county_id', 'constituency_name', 'ward', 'alias'];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function wards()
    {
        return $this->hasMany(SubCountyWard::class);
    }
}
