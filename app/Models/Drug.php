<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Drug extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = ['name'];

    public function stockMovements() {
    return $this->hasMany(StockMovement::class);
}

public function prescriptions() {
    return $this->hasMany(Prescription::class);
}

public function sales() {
    return $this->hasMany(Sale::class);
}
public function batches()
{
    return $this->hasMany(DrugBatch::class);
}

}