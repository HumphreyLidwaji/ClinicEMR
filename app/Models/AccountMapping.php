<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class AccountMapping extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'entity_type', // e.g. 'lab', 'med', 'service', etc.
        'entity_id',   // id of the mapped entity
        'account_id',  // id from accounts table
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    
public function entity()
{
    $map = [
        'lab' => \App\Models\Lab::class,
        'med' => \App\Models\Medication::class,
        'service' => \App\Models\Service::class,
        'procedure' => \App\Models\Procedure::class,
        'imaging' => \App\Models\Imaging::class,
        'item' => \App\Models\Item::class,
        'insurance' => \App\Models\Insurance::class,
        'vendor' => \App\Models\Vendor::class,
        'payroll' => \App\Models\PayrollDeduction::class,
        'department' => \App\Models\Department::class,
    ];
    $model = $map[$this->entity_type] ?? null;
    return $model ? $model::find($this->entity_id) : null;
}

    public function getEntityTypeLabelAttribute()
    {
        return match ($this->entity_type) {
            'lab' => 'Laboratory',
            'med' => 'Medication',
            'service' => 'Service',
            'procedure' => 'Procedure',
            'imaging' => 'Imaging',
            'item' => 'Item',
            'insurance' => 'Insurance',
            'vendor' => 'Vendor',
            'payroll' => 'Payroll Deduction',
            'department' => 'Department',
            default => ucfirst($this->entity_type),
        };
    }

    public function getFormattedAccountAttribute()
    {
        return $this->account ? $this->account->name . ' (' . $this->account->code . ')' : 'No Account';
    }

    public function getEntityNameAttribute()
    {
        $entity = $this->entity();
        return $entity ? $entity->name : 'Unknown Entity';
    }

    
}