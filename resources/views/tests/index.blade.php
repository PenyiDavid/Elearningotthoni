<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Choose test</h1>

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
    
    <ul>
        @foreach ($subjects as $subject)
            <li><a href="{{ route('test.show', $subject->subject_name) }}">{{ $subject->subject_name }}</a></li>
        @endforeach
</body>
</html>