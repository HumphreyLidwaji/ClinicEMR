<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Payment extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'invoice_number',
        'patient_name',
        'method',
        'amount',
        'paid_at',
    ];

    protected $dates = ['paid_at'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_number', 'invoice_number');
    }

    
}