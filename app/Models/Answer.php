<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['question_id', 'answer_text', 'is_correct'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
