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

{{--<form action="{{ route('signin') }}" method="post">--}}
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    {{--<input type="text" name="name"><br>--}}
    {{--<input type="email" name="email"><br>--}}
    {{--<input type="submit" name="Submit">--}}
{{--</form>--}}

{{--<div--}}
        {{--class="fb-like"--}}
        {{--data-share="true"--}}
        {{--data-width="450"--}}
        {{--data-show-faces="true">--}}
{{--</div>--}}



{{--<script>--}}
    {{--// This is called with the results from from FB.getLoginStatus().--}}
    {{--function statusChangeCallback(response) {--}}
        {{--console.log('statusChangeCallback');--}}
        {{--console.log(response);--}}
        {{--// The response object is returned with a status field that lets the--}}
        {{--// app know the current login status of the person.--}}
        {{--// Full docs on the response object can be found in the documentation--}}
        {{--// for FB.getLoginStatus().--}}
        {{--if (response.status === 'connected') {--}}
            {{--// Logged into your app and Facebook.--}}
            {{--testAPI();--}}
        {{--} else {--}}
            {{--// The person is not logged into your app or we are unable to tell.--}}
            {{--document.getElementById('status').innerHTML = 'Please log ' +--}}
                {{--'into this app.';--}}
        {{--}--}}
    {{--}--}}

    {{--// This function is called when someone finishes with the Login--}}
    {{--// Button.  See the onlogin handler attached to it in the sample--}}
    {{--// code below.--}}
    {{--function checkLoginState() {--}}
        {{--FB.getLoginStatus(function(response) {--}}
            {{--statusChangeCallback(response);--}}
        {{--});--}}
    {{--}--}}

    {{--function fbLogOut() {--}}
        {{--FB.logout(function(response) {--}}
            {{--// user is now logged out--}}
        {{--});--}}
    {{--}--}}

    {{--window.fbAsyncInit = function() {--}}
        {{--FB.init({--}}
            {{--appId      : '177732936171160',--}}
            {{--cookie     : true,  // enable cookies to allow the server to access--}}
                                {{--// the session--}}
            {{--xfbml      : true,  // parse social plugins on this page--}}
            {{--version    : 'v2.8' // use graph api version 2.8--}}
        {{--});--}}

        {{--// Now that we've initialized the JavaScript SDK, we call--}}
        {{--// FB.getLoginStatus().  This function gets the state of the--}}
        {{--// person visiting this page and can return one of three states to--}}
        {{--// the callback you provide.  They can be:--}}
        {{--//--}}
        {{--// 1. Logged into your app ('connected')--}}
        {{--// 2. Logged into Facebook, but not your app ('not_authorized')--}}
        {{--// 3. Not logged into Facebook and can't tell if they are logged into--}}
        {{--//    your app or not.--}}
        {{--//--}}
        {{--// These three cases are handled in the callback function.--}}

        {{--FB.getLoginStatus(function(response) {--}}
            {{--statusChangeCallback(response);--}}
        {{--});--}}

    {{--};--}}

    {{--// Load the SDK asynchronously--}}
    {{--(function(d, s, id) {--}}
        {{--var js, fjs = d.getElementsByTagName(s)[0];--}}
        {{--if (d.getElementById(id)) return;--}}
        {{--js = d.createElement(s); js.id = id;--}}
        {{--js.src = "https://connect.facebook.net/en_US/sdk.js";--}}
        {{--fjs.parentNode.insertBefore(js, fjs);--}}
    {{--}(document, 'script', 'facebook-jssdk'));--}}

    {{--// Here we run a very simple test of the Graph API after login is--}}
    {{--// successful.  See statusChangeCallback() for when this call is made.--}}
    {{--function testAPI() {--}}
        {{--console.log('Welcome!  Fetching your information.... ');--}}
        {{--FB.api('/me', function(response) {--}}
            {{--console.log("responce", response);--}}
            {{--console.log('Successful login for: ' + response.name);--}}
            {{--document.getElementById('status').innerHTML =--}}
                {{--'Thanks for logging in, ' + response.name + '!';--}}
        {{--});--}}
    {{--}--}}
{{--</script>--}}

{{--<!----}}
  {{--Below we include the Login Button social plugin. This button uses--}}
  {{--the JavaScript SDK to present a graphical Login button that triggers--}}
  {{--the FB.login() function when clicked.--}}
{{---->--}}

{{--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">--}}
{{--</fb:login-button>--}}

{{--<div id="status"></div>--}}

    {{--<fb:logout-button onlogout="fbLogOut();">--}}
    {{--</fb:logout-button>--}}

<a href="https://api.intra.42.fr/oauth/authorize?client_id=ad0570aea500deeacfb27d1cb682999daa4c43b6b171ca99ff9ea2713562d4aa&redirect_uri=http%3A%2F%2Flocalhost%3A80%2Fintralogin&response_type=code
" class="btn btn-info">Intra 42 <img src="https://signin.intra.42.fr/assets/42_logo_black-684989d43d629b3c0ff6fd7e1157ee04db9bb7a73fba8ec4e01543d650a1c607.png" alt="Intra 42 logo"></a>
{{--<fb:login-button--}}
        {{--scope="public_profile,email"--}}
        {{--onlogin="checkLoginState();">--}}
{{--</fb:login-button>--}}

{{--<a href="/facebooklogin">face</a>--}}

<a href="{{$loginFb}}">Log in with Facebook!</a>
</body>
</html>