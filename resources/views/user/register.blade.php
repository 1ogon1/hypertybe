<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eee</title>
</head>
<body>

<h1>Say welcome</h1>

<p><a href="/">Home</a></p>

<form action="{{ route('signup') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="name"><br>
    <input type="email" name="email"><br>
    <input type="password" name="password"><br>
    <input type="submit" name="Submit">
</form>

</body>
</html>