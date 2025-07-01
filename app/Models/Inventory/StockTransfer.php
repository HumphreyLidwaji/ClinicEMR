<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'from_store_id',
        'to_store_id',
        'quantity',
        'transfer_date',
    ];

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