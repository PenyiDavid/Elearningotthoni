<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>New question</h1>
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

    <form action="{{route('question.store')}}" method="POST">
        @csrf
        <label for="subject_id">Subject</label>
        <select name="subject_id" id="subject_id">
            @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
            @endforeach
        </select><br>
        
        <label for="question_text">Question name</label>
        <input type="text" name="question_text" id="question_text"><br>

        <div class="answer-group">
        <label for="answer1">Answer 1</label>
        <input type="text" name="answers[0][answer]" id="answer[0][answer]" placeholder="Answer 1">
        <input type="hidden" name="answers[0][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel -->
        <input type="checkbox" name="answers[0][is_correct]" value="1"> Correct Answer<br>

        <label for="answer2">Answer 2</label>
        <input type="text" name="answers[1][answer]" placeholder="Answer 2" required>
        <input type="hidden" name="answers[1][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel --> 
        <input type="checkbox" name="answers[1][is_correct]" value="1"> Correct Answer<br>
        
        <label for="answer3">Answer 3</label>
        <input type="text" name="answers[2][answer]" placeholder="Answer 3"> <!-- Nincs required -->
        <input type="hidden" name="answers[2][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel -->
        <input type="checkbox" name="answers[2][is_correct]" value="1"> Correct Answer<br>

        <label for="answer4">Answer 4</label>
        <input type="text" name="answers[3][answer]" placeholder="Answer 4"> <!-- Nincs required -->
        <input type="hidden" name="answers[3][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel -->
        <input type="checkbox" name="answers[3][is_correct]" value="1"> Correct Answer<br>
        </div>
        <button type="submit">Save</button>
    </form>
</body>
</html>