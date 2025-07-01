<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class LabTest extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;


    protected $fillable = ['name', 'price', 'description', 'account_id'];


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function visits()
    {
        return $this->belongsToMany(Visit::class, 'visit_lab_test')
                    ->withPivot('quantity', 'total_price');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}