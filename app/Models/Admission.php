<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Admission  extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    protected $fillable = [
         'visit_id', 'requested_by', 'approved_by', 'bed_id',
        'admission_date', 'discharge_date', 'status', 'notes'
    ];
    protected $casts = [
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
    ];

    public function transferHistories()
    {
        return $this->hasMany(TransferHistory::class);
    }
public function ward()
{
    return $this->belongsTo(Ward::class);
}
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Pending',
            'admitted' => 'admitted',
            'discharged' => 'Discharged',
            default => 'Unknown',
        };
    }


public function approve($userId)
{
    $this->status = 'admitted';
    $this->approved_by = $userId;
    $this->admission_date = now();
    $this->save();
}

public function assignBed($bedId)
{
    $this->bed_id = $bedId;
    $this->save();
}

public function assignWard($wardId)
{
    // Assuming you have a ward_id column or via the bed relationship
    $this->bed && $this->bed->ward_id = $wardId;
    $this->save();
}


}