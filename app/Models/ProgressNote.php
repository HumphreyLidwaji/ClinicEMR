<?php
// app/Models/ProgressNote.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id', 'progress_date', 'subjective', 'objective', 'assessment', 'plan', 'created_by',
    ];
}
