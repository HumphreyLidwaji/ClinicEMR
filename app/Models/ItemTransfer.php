<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ItemTransfer extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['item_id', 'from_store_id', 'to_store_id', 'quantity', 'transferred_by', 'transfer_date', 'notes'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function fromStore()
    {
        return $this->belongsTo(Store::class, 'from_store_id');
    }

    public function toStore()
    {
        return $this->belongsTo(Store::class, 'to_store_id');
    }
}
