<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Category extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}