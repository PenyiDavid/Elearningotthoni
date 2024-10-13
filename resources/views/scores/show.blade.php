<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Az eredményeid</h1>

        <p><strong>Email:</strong> {{ $score->email }}</p>
        <p><strong>Tárgy:</strong> {{ $score->subject->subject_name }}</p>
        <p><strong>Összpontszám:</strong> {{ $score->score }}</p>

        <ul>
            @foreach ($score->subject->questions as $question)
                <li>
                    <p><strong>Kérdés:</strong> {{ $question->question_text }}</p>

                    <!-- Helyes válasz -->
                    <p><strong>Helyes válasz:</strong>
                        @foreach ($question->answers as $answer)
                            @if ($answer->is_correct)
                                {{ $answer->answer_text }}
                            @endif
                        @endforeach
                    </p>
                </li>
            @endforeach
        </ul>
</body>
</html>