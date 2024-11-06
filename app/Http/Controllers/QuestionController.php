<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {   $query = Question::query();
        if($request->has('subject_name') && !empty($request->subject_name)){
            $subject = Subject::where('subject_name','=', $request->subject_name)->first();
            if ($subject) {
                $query->where('subject_id', '=',$subject->id);
            }
        }

        $questions = $query->get();
        $subjects = Subject::all();
        return view('questions.index', ['subjects'=>$subjects, 'questions'=>$questions], );
    }
    public function create()
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
    public function show(Question $question)
    {
        $subjects = Subject::all();
        return view('questions.edit', compact('question', 'subjects'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'answers' => 'required|array|min:2',
            'answers.*.id' => 'required|exists:answers,id',
            'answers.*.answer_text' => 'required|string|max:255',
        ]);

        $question = Question::findOrFail($id);
        $question->update($request->only('question_text', 'subject_id')); // Kérdés frissítése

        // Válaszok frissítése
        foreach ($request->input('answers') as $answerData) {
            $answer = Answer::findOrFail($answerData['id']);
            $answer->update([
                'answer_text' => $answerData['answer_text'],
                'is_correct' => isset($answerData['is_correct']) ? $answerData['is_correct'] : 0,
            ]);
        }

        return redirect()->route('question.index')->with('success', 'Question successfully updated.'); // Visszajelzés
    }
    public function destroy($id)
    {
        $question = Question::findOrFail($id); 
        $question->answers()->delete(); // A válaszok törlése
        $question->delete();
        return redirect()->route('question.index')->with('success', 'Question successfully deleted.');
    }
}
