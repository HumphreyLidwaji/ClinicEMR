<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class TransferHistory extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'admission_id', 'from_ward_id', 'to_ward_id', 'from_bed_id', 'to_bed_id', 'transferred_by', 'transferred_at', 'notes'
    ];

    public function admission() { return $this->belongsTo(Admission::class); }
    public function fromWard() { return $this->belongsTo(Ward::class, 'from_ward_id'); }
    public function toWard() { return $this->belongsTo(Ward::class, 'to_ward_id'); }
    public function fromBed() { return $this->belongsTo(Bed::class, 'from_bed_id'); }
    public function toBed() { return $this->belongsTo(Bed::class, 'to_bed_id'); }
    public function user() { return $this->belongsTo(User::class, 'transferred_by'); }
}