<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
use App\Models\Subject;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/newsubject', [SubjectController::class, 'index'])->name('subject.index');
Route::post('/newsubject', [SubjectController::class, 'store'])->name('subject.store');

Route::get('/newquestion', [QuestionController::class, 'create'])->name('question.create');
Route::post('/newquestion', [QuestionController::class, 'store'])->name('question.store');

Route::get('/questions', [QuestionController::class, 'index'])->name('question.index');
Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('question.show');
Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('question.update');
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

Route::get('/tests', [TestController::class, 'index'])->name('test.index');
Route::get('tests/{test}', [TestController::class, 'show'])->name('test.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
