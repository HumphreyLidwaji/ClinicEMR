<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class LabResult extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;
    protected $fillable = ['order_id', 'template_id', 'results', 'resulted_at'];

    protected $casts = [
        'results' => 'array',
        'resulted_at' => 'datetime',
    ];




    public function order()
    {
        return $this->belongsTo(LabOrder::class);
    }

    public function template()
    {
        return $this->belongsTo(LabResultTemplate::class);
    }

  
}
