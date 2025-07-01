<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Account extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory; protected $fillable = ['name', 'type', 'code','account_balance'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    
}