<?php

namespace App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'stock',
        'unit',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getStockStatusAttribute()
    {
        return $this->stock > 0 ? 'In Stock' : 'Out of Stock';
    }
    
}