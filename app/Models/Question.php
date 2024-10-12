<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['question_text', 'subject_id'];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
