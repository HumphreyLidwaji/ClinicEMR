<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Transaction extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = [
        'account_id', 'date', 'description', 'type', 'amount'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}