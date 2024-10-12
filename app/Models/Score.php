<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['email', 'subject_id', 'score'];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
}
