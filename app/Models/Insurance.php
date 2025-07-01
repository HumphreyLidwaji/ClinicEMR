<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Insurance extends Model implements AuditableContract
{
      use Auditable;
  protected $fillable = ['name', 'code', 'contact_person', 'phone', 'email', 'account_id'];


public function account()
{
    return $this->belongsTo(Account::class);
}


}
