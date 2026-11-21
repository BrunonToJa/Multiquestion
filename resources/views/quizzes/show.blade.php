@extends('layout')

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    @if ($quiz->questions->isEmpty())
        <p>Ten quiz nie ma jeszcze pytań. Dodaj pierwsze poniżej.</p>
    @else
        <form method="POST" action="{{ route('quizzes.submit', $quiz) }}">
            @csrf
            @foreach ($quiz->questions as $question)
                <fieldset>
                    <legend>{{ $loop->iteration }}. {{ $question->content }}</legend>
                    @foreach ($question->answers as $answer)
                        <label>
                            <input type="radio" name="answers[{{ $question->id }}]"
                                   value="{{ $answer->id }}"
                                   @checked(old("answers.{$question->id}") == $answer->id)>
                            {{ $answer->content }}
                        </label><br>
                    @endforeach
                    @error("answers.{$question->id}") <strong>{{ $message }}</strong> @enderror
                </fieldset>
            @endforeach
            <button type="submit">Sprawdź</button>
        </form>
    @endif

    <hr>
    <h2>Dodaj pytanie</h2>
    <form method="POST" action="{{ route('questions.store', $quiz) }}">
        @csrf
        <p>
            <label>Treść pytania</label><br>
            <input type="text" name="content" value="{{ old('content') }}">
            @error('content') <br><strong>{{ $message }}</strong> @enderror
        </p>
        @for ($i = 0; $i < 3; $i++)
            <p>
                <label>Odpowiedź {{ $i + 1 }}</label><br>
                <input type="text" name="options[{{ $i }}]" value="{{ old("options.$i") }}">
                <label>
                    <input type="radio" name="correct" value="{{ $i }}"
                           @checked(old('correct') !== null && old('correct') == $i)>
                    poprawna
                </label>
                @error("options.$i") <br><strong>{{ $message }}</strong> @enderror
            </p>
        @endfor
        @error('correct') <p><strong>{{ $message }}</strong></p> @enderror
        <button type="submit">Dodaj pytanie</button>
    </form>
@endsection