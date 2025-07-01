<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class LabResultTemplate extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['name', 'fields'];

    protected $casts = [
        'fields' => 'array',
    ];

    public function results()
    {
        return $this->hasMany(LabResult::class);
    }

    public function getFieldsAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setFieldsAttribute($value)
    {
        $this->attributes['fields'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getFieldsAsJson()
    {
        return json_encode($this->fields);
    }
    
}
