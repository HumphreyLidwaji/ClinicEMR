<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class GoodsReceivedNote extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['purchase_order_id', 'received_by', 'received_date', 'store_id', 'notes'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function items()
    {
        return $this->hasMany(GRNItem::class, 'grn_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
