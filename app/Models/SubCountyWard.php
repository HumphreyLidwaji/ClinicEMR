<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subcounty;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class SubCountyWard extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $table = 'sub_county_wards'; // Explicitly define table name
    protected $fillable = [
        'subcounty_id',
        'ward_name',
    ];

    // Relationships
    public function subcounty()
    {
        return $this->belongsTo(Subcounty::class);
    }

   

public function wards()
{
    return $this->hasMany(SubCountyWard::class, 'subcounty_id');
}

}
