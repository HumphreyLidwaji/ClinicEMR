<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class PaymentItem extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'payment_id',
        'invoice_item_id',
        'amount_paid',
    ];

    // Relationships

    public function payment()
    {
        return $this->belongsTo(\App\Models\Billing\Payment::class);
    }

    public function invoiceItem()
    {
        return $this->belongsTo(\App\Models\Billing\InvoiceItem::class);
    }
}
