<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Question</h1>

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

    <form action="{{ route('question.update', $question->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="subject_id">Select Subject</label>
    <select name="subject_id" required>
        <option value="" disabled>Select a subject</option>
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ $subject->id == $question->subject_id ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
        @endforeach
    </select>
    
    <label for="question_text">Question</label>
    <input type="text" name="question_text" value="{{ $question->question_text }}" required><br>

    <h5>Answers</h5>
    @foreach($question->answers as $index => $answer)
        <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $answer->id }}">
        <input type="text" name="answers[{{ $index }}][answer_text]" value="{{ $answer->answer_text }}" required>
        <input type="checkbox" name="answers[{{ $index }}][is_correct]" value="1" {{ $answer->is_correct ? 'checked' : '' }}> Correct Answer <br>
    @endforeach
    <button type="submit">Update Question</button>
</form>
</body>
</html>