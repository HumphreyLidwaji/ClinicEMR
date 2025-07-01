<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class GRNItem extends Model implements AuditableContract
{
      use Auditable;
    protected $table = 'grn_items'; 
    protected $fillable = ['grn_id', 'item_id', 'received_quantity'];

    public function grn()
    {
        return $this->belongsTo(GoodsReceivedNote::class, 'grn_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
