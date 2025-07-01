<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class StockAdjustment extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['item_id', 'store_id', 'adjustment_type', 'quantity', 'reason', 'adjusted_by', 'adjusted_at'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
