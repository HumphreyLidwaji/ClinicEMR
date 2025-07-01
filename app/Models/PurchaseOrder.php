<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class PurchaseOrder extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['supplier_name', 'order_date', 'expected_date', 'status'];

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function grns()
    {
        return $this->hasMany(GoodsReceivedNote::class);
    }
}
