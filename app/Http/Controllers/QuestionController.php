<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store()
    {
        $question = new Question();
        $question->question_text = request('question_text');
        $question->subject_id = request('subject_id');
        $question->save();
        return redirect('/newquestion');
    }
}
