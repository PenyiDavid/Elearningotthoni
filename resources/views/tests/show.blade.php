<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{$subject->subject_name}} test</h1>
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    @if(@session('success'))
        <p>{{session('success')}}</p>
    @endif

    <form action="{{ route('score.store', $subject->subject_name) }}" method="post">
        @csrf
        <ul>
            @foreach ($questions as $question)
                <li>
                    <p>{{$question->question_text}}</p>
                    <ul>
                        @foreach ($question->answers as $answer)
                            <li>
                                <input type="checkbox" name="answers[{{$question->id}}]" value="{{$answer->id}}" id="answer{{$answer->id}}">
                                <label for="answer{{$answer->id}}">{{$answer->answer_text}}</label>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
        <button type="submit">Submit</button>
</body>
</html>