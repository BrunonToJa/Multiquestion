@extends('layout')

@section('content')
    <h1>Quizy</h1>
    @forelse ($quizzes as $quiz)
        <p>
            <a href="{{ route('quizzes.show', $quiz) }}">{{ $quiz->title }}</a>
            ({{ $quiz->questions_count }} pytania)
        </p>
    @empty
        <p>Brak quizów.</p>
    @endforelse
@endsection