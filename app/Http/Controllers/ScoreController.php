<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Score;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store(Request $request, $subject_name)
    {
        // 1. Ellenőrizni kell, hogy az email és tantárgy már szerepel-e a scores táblában.
        $subject = Subject::where('subject_name', $subject_name)->first();
        $newTest = Score::where('email', $request->email)
        ->where('subject_id', $subject->id)
        ->first();

        if ($newTest) {
        return redirect()->back()->with('error', 'Már kitöltötted a tesztet.');
        }

        // 2. Ellenőrizni, hogy minden kérdésre jött-e válasz.

        //$questions = Question::where('subject_id', $subject->id)->get(); így is lehetne
        $questions = $subject->questions;
        $answersGiven = $request->input('answers');

        if (!is_array($answersGiven) || count($answersGiven) != $questions->count()) {
        return redirect()->back()->with('error', 'Nem minden kérdésre válaszoltál.');
        }

        $score = 0;

        // 3. Ellenőrizni, hogy a felhasználó jó válaszokat adott-e meg.
        foreach ($questions as $question) {
            $userAnswerIds = $answersGiven[$question->id] ?? []; // Tömbként várjuk a válaszokat

            if (is_array($userAnswerIds) && !empty($userAnswerIds)) {
                // Lekérjük az összes helyes választ az adott kérdéshez
                $correctAnswers = Answer::where('question_id', $question->id)
                                        ->where('is_correct', true)
                                        ->pluck('id'); // Csak az id-k kellenek

                // Minden felhasználói választ összehasonlítunk a helyes válaszokkal
                foreach ($userAnswerIds as $userAnswerId) {
                    if ($correctAnswers->contains($userAnswerId)) {
                        $score++; // Ha a felhasználó válasza benne van a helyes válaszokban, növeljük a pontszámot
                    }
                }
            }
        }

        // 4. Pontszám mentése a scores táblába.
        $score = Score::create([
        'email' => $request->email,
        'subject_id' => $subject->id,
        'score' => $score,
        ]);

        return redirect()->route('score.show', ['score' => $score->id])
                 ->with('success', 'Sikeres tesztkitöltés!');
    }

    public function show($score)
    {
        $score = Score::find($score);
        return view('scores.show', compact('score'));
    }
}
