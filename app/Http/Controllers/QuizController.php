<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    public function index()
    {
        return view('quizzes.index', ['quizzes' => Quiz::withCount('questions')->get()]);
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $quiz = Quiz::create($data);

        return redirect()->route('quizzes.show', $quiz)->with('status', 'Quiz został utworzony.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('quizzes.show', ['quiz' => $quiz]);
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $quiz->load('questions.answers');

        $rules = [];
        foreach ($quiz->questions as $question) {
            $rules["answers.{$question->id}"] = [
                'required',
                Rule::exists('answers', 'id')->where('question_id', $question->id),
            ];
        }
        $data = $request->validate($rules, [
            'answers.*.required' => 'Odpowiedz na wszystkie pytania.',
        ]);

        $score = Answer::whereIn('id', $data['answers'])->where('is_correct', true)->count();

        return view('quizzes.result', [
            'quiz' => $quiz,
            'score' => $score,
            'total' => $quiz->questions->count(),
        ]);
    }
}