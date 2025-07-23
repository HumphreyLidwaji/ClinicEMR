<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Store extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['name', 'location'];

    public function stocks()
    {
        return $this->hasMany(ItemStock::class);
    }

    public function transfersFrom()
    {
        return $this->hasMany(ItemTransfer::class, 'from_store_id');
    }

    public function transfersTo()
    {
        return $this->hasMany(ItemTransfer::class, 'to_store_id');
    }

    public function grns()
    {
        return $this->hasMany(GoodsReceivedNote::class);
    }
}
