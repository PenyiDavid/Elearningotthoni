<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('questions.create', compact('subjects'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // Ellenőrizzük, hogy a tantárgy létezik-e
            'answers' => 'required|array|min:2', // Legalább 2 válasz szükséges
            'answers.*.is_correct' => 'boolean|min:1', // A válasz helyessége logikai érték
        ]);
    
        // Új kérdés létrehozása
        $question = Question::create([
            'question_text' => $request->input('question_text'),
            'subject_id' => $request->input('subject_id'),
        ]);
    
        // Válaszok hozzáadása
        foreach ($request->input('answers') as $answerData) {
            // Ha nincs is_correct megadva, akkor alapértelmezett 0
            if(isset($answerData['answer']) && $answerData['answer'] != '') {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answerData['answer'],
                    'is_correct' => isset($answerData['is_correct']) ? $answerData['is_correct'] : 0, // Ha nincs bejelölve, 0
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'New question successfully added.'); // Visszajelzés
    }
}
