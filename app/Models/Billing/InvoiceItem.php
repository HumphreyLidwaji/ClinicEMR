<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class InvoiceItem extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'description',
        'quantity',
        'unit_price',
        'total',
        'revenue_account_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    
}