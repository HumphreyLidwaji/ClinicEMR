<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class VisitNote extends Model implements AuditableContract
{
      use Auditable;
    protected $fillable = ['visit_id', 'note_type', 'note', 'user_id'];
    public function visit() { return $this->belongsTo(Visit::class); }
    public function user() { return $this->belongsTo(User::class); }
}