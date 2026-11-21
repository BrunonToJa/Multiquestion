<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quizy</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav>
        <div class="container">
            <a href="{{ route('quizzes.index') }}">Lista quizów</a>
            <a href="{{ route('quizzes.create') }}">Nowy quiz</a>
        </div>
    </nav>
    <main class="container">
        @if (session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif
        @yield('content')
    </main>
</body>
</html>