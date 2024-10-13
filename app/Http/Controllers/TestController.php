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
    
}
