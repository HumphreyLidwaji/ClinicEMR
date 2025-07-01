<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class GoodsReceivedNote extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'grn_number',
        'purchase_order_id',
        'received_date',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}