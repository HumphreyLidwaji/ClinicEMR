<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class Ward extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['name', 'description'];

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}