<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>New subject</h1>
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
    
    <form action="{{route('subject.store')}}" method="POST">
        @csrf
        <label for="subject_name">Subject_name</label>
        <input type="text" name="subject_name" id="subject_name">
        <button type="submit">Save</button>
    </form>
</body>
</html>