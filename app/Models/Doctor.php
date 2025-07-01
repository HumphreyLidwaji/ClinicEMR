<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Doctor extends Model implements AuditableContract
{
      use Auditable;
    // Optional: specify fillable fields
    protected $fillable = ['name', 'specialty'];

    // Optional: define relationships   
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }       
    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'appointments');
    }
}
