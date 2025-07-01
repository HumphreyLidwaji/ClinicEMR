<?php

namespace App\Models\Laboratory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\LabOrder;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class SampleCollection extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    protected $fillable = ['order_id', 'sample_type', 'collected_at'];
    protected $casts = [
        'collected_at' => 'datetime',
    ];      

 

    public function order()
{
    return $this->belongsTo(LabOrder::class, 'order_id');
}


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
  

    public function visit()
    {
        return $this->order?->visit();
    }
}