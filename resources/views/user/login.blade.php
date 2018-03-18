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

@if (session('success'))
    {{ session('success') }}
@endif
@if (session('warning'))
    {{ session('warning') }}
@endif

<form action="{{ route('signin') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="email" name="email" placeholder="email" required><br>
    <input type="password" name="password" placeholder="password" required><br>
    <input type="submit" name="Submit">
</form>

<a href="https://api.intra.42.fr/oauth/authorize?client_id=ad0570aea500deeacfb27d1cb682999daa4c43b6b171ca99ff9ea2713562d4aa&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fintralogin&response_type=code
" class="btn btn-info">Intra 42 <img src="https://signin.intra.42.fr/assets/42_logo_black-684989d43d629b3c0ff6fd7e1157ee04db9bb7a73fba8ec4e01543d650a1c607.png" alt="Intra 42 logo"></a>

<a href="{{$loginFb}}">Log in with Facebook!</a>
</body>
</html>