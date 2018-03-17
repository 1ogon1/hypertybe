<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Say hello!!</h1>


<img src="{{$user->image}}" width="150">
@if ($_SESSION['user_id'] == $user->id)
<form action="{{ route('update') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="file" name="image"><br>
    <input type="hidden" name="id" value="{{$user->id}}">
    <input type="text" name="name" value="{{$user->name}}" placeholder="name"><br>
    <input type="text" name="surname" value="{{$user->surname}}" placeholder="surname"><br>
    <input type="email" name="email" value="{{$user->email}}" placeholder="email"><br>
    <input type="password" name="password" placeholder="new password"><br>
    <input type="submit" name="Submit">
</form>
@else
    <p>{{$user->name}}</p>
    <p>{{$user->surname}}</p>
    <p>{{$user->email}}</p>
@endif
<a href="/logout">logout</a>

</body>
</html>