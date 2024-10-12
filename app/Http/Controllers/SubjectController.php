<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('subjects.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
        ]);
        Subject::create($request->all());
        return redirect()->back()->with('success', 'Subject created successfully');
    }
}
