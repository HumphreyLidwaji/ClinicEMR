<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Invoice extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'patient_name',
        'visit_type',
        'visit_id',
        'amount',
        'status',
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



public function items()
{
    return $this->hasMany(\App\Models\Billing\InvoiceItem::class);
}


    /**
     * Get the visit associated with the invoice.
     */ 
    public function visit()
    {
        return $this->belongsTo(\App\Models\Visit::class, 'visit_id');
    }
    /**
     * Get the formatted invoice number.
     */         
    public function getFormattedInvoiceNumberAttribute()    
    
    {
        return strtoupper($this->invoice_number);
    }
    /**
     * Get the formatted amount with currency symbol.
     */ 
    public function getFormattedAmountAttribute()               
    {
        return 'Kshs' . number_format($this->amount, 2);
    }

    public function getStatusAttribute($value)
    {
        return $value === 'paid' ? 'Paid' : 'Unpaid';
    }
    
}