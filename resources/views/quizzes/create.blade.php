@extends('layout')

@section('content')
    <h1>Nowy quiz</h1>
    <form method="POST" action="{{ route('quizzes.store') }}">
        @csrf
        <p>
            <label>Tytuł</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title') <br><strong>{{ $message }}</strong> @enderror
        </p>
        <p>
            <label>Opis</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description') <br><strong>{{ $message }}</strong> @enderror
        </p>
        <button type="submit">Zapisz</button>
    </form>
@endsection