<?php
// app/Models/ClinicSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class ClinicSetting extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['key', 'value'];

    public static function getValue($key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function setValue($key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
