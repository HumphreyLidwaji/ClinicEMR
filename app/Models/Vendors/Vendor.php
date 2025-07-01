<?php

namespace App\Models\Vendors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Vendor extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
    ];
}