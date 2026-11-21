@extends('layout')

@section('content')
    <h1>Wynik: {{ $quiz->title }}</h1>
    <p>Poprawne odpowiedzi: {{ $score }} / {{ $total }}</p>
    <a href="{{ route('quizzes.show', $quiz) }}">Spróbuj ponownie</a>
@endsection