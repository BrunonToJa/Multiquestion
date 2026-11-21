<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/quizzes');

Route::middleware('log.request')->group(function () {
    Route::resource('quizzes', QuizController::class)
        ->only(['index', 'create', 'store', 'show']);
    Route::post('quizzes/{quiz}/submit', [QuizController::class, 'submit'])
        ->name('quizzes.submit');
    Route::post('quizzes/{quiz}/questions', [QuestionController::class, 'store'])
        ->name('questions.store');
});