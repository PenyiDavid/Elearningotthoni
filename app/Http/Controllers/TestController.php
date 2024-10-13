<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('tests.index', compact('subjects'));
    }

    public function show($subject_name)
    {
        $subject = Subject::where('subject_name', $subject_name)->first();
        
        $questions = $subject->questions;
        return view('tests.show', compact('subject', 'questions'));
    }
    
}
