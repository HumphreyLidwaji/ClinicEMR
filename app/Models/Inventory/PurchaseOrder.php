<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendors\Vendor;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number',
        'supplier_id',
        'status',
        'expected_date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Vendor::class, 'supplier_id');
    }
    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }
    
}