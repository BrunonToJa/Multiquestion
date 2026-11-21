<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'content' => 'required|string|min:3|max:500',
            'options' => 'required|array|size:3',
            'options.*' => 'required|string|max:255',
            'correct' => 'required|integer|between:0,2',
        ]);

        $question = $quiz->questions()->create(['content' => $data['content']]);

        foreach ($data['options'] as $index => $text) {
            $question->answers()->create([
                'content' => $text,
                'is_correct' => $index == $data['correct'],
            ]);
        }

        return redirect()->route('quizzes.show', $quiz)->with('status', 'Pytanie zostało dodane.');
    }
}