@include('layout.header')

@if (session('success'))
    <div class="row">
        <div class="col-md-12 alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif
@if (session('info'))
    <div class="row">
        <div class="col-md-12 alert alert-info">
            {{ session('info') }}
        </div>
    </div>
@endif
@if (session('warning'))
    <div class="row">
        <div class="col-md-12 alert alert-warning">
            {{ session('warning') }}
        </div>
    </div>
@endif

<div class="row">
    <div class="col-sm-3">
        <form action="{{ route('signin') }}" method="post">
            <h1>Login</h1>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email">Email adress</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                       placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                       placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
            <a href="/reset">Forgot password?</a>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 login-with">
        <div class="row">
            <div class="col-sm-6">
                <p>Login with</p>
            </div>
            <div class="col-sm-6">
<span class="intra">
<a href="https://api.intra.42.fr/oauth/authorize?client_id=ad0570aea500deeacfb27d1cb682999daa4c43b6b171ca99ff9ea2713562d4aa&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fintralogin&response_type=code"
   class="">
<img src="https://signin.intra.42.fr/assets/42_logo_black-684989d43d629b3c0ff6fd7e1157ee04db9bb7a73fba8ec4e01543d650a1c607.png"
     alt="Intra 42 logo">
</a>
</span>
                <span class="fb">
<a href="{{$loginFb}}"><img src="{{URL::asset('image/fb.ico')}}"></a>
</span>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')