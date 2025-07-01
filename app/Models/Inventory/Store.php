<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'manager_name',
    ];
    public function stockTransfers()
    {
        return $this->hasMany(StockTransfer::class, 'from_store_id');
    }

    public function incomingTransfers()
    {
        return $this->hasMany(StockTransfer::class, 'to_store_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'store_id');
    }

    
}