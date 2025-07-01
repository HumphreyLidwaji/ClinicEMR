<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Service extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = ['name', 'price'];
    protected $casts = [
        'price' => 'decimal:2',
    ];
    public function visits()
    {
        return $this->belongsToMany(Visit::class, 'visit_service')
                    ->withPivot('quantity', 'total_price');
    }
    
}