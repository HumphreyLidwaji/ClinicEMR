<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Employee extends Model implements AuditableContract
{
      use Auditable;
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'gender', 'date_of_birth',
        'national_id', 'email', 'phone_number', 'address', 'city', 'county',
        'country', 'postal_code', 'employee_number', 'hire_date', 'position',
        'department', 'employment_type', 'contract_end_date', 'is_active',
        'basic_salary', 'bank_name', 'bank_account', 'nhif_number', 'nssf_number', 'kra_pin'
    ];
}
