<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('test')}}" method="post">
        @csrf
        <input type="text" name="student_email" id="">
        <input type="text" name="student_password" id="">
        <input type="submit" value="submit">
    </form>
</body>
</html>