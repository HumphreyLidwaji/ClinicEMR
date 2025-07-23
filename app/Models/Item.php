<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Item extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['name', 'description', 'category_id', 'unit', 'reorder_level', 'is_active'];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function stocks()
    {
        return $this->hasMany(ItemStock::class);
    }

    public function transfers()
    {
        return $this->hasMany(ItemTransfer::class);
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function grnItems()
    {
        return $this->hasMany(GRNItem::class);
    }

    public function stockAdjustments()
    {
        return $this->hasMany(StockAdjustment::class);
    }
}
