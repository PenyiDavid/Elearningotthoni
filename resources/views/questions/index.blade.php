<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Questions List</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    <a href="{{ route('question.create') }}">Add New Question</a>


    <form method="GET" action="{{ route('question.index')}}" class="mb-4">
        @csrf
        <label for="subject_name">Subject name:</label>
        <select name="subject_name" id="subject_name">
            @foreach($subjects as $subject)
                <option value="{{$subject->subject_name}}">{{$subject->subject_name}}</option>
            @endforeach
        </select>
        <button type="submit" >Search</button>
        <a href="{{route('question.index')}}" >Szűrők törlése</a>
    </form>
    

    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Question</th>
                <th>Answes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->subject->subject_name }}</td>
                    <td>{{ $question->question_text }}</td>
                    <td>
                        <ul>
                            @foreach($question->answers as $answer)
                                <li>{{ $answer->answer_text }} - {{ $answer->is_correct ? 'Correct' : 'Incorrect' }}</li>
                            @endforeach
                        </ul>
                    <td>
                        <a href="{{ route('question.show', $question->id) }}" >Edit</a>
                        <form action="{{ route('question.destroy', $question->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>