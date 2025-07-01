<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class RadiologyResult extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'order_id',
        'test_name',
        'resulted_by',
        'remarks',
        'results',
    ];

    protected $casts = [
        'results' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(RadiologyOrder::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function service()
    {
        return $this->belongsTo(RadiologyService::class, 'service_id');
    }
}

