<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ItemCategory extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['name', 'description'];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
