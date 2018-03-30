@include('layout.header')

@if (session('error'))
    <div class="row">
        <div class="col-md-12 alert alert-danger">
            <span class="">
                {!! session('error') !!}
            </span>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-3">
        <form action="{{ route('signup') }}" method="post">
            <h1>Регитрация</h1>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="name" class="form-control" name="name" id="name" aria-describedby="name"
                       placeholder="Введите имя" required>
            </div>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input type="surname" class="form-control" name="surname" id="surname" aria-describedby="surname"
                       placeholder="Введите фамилию" required>
            </div>
            <div class="form-group">
                <label for="email">Email адресс</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
                       placeholder="Введите email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="password"
                       placeholder="Введите пароль" required>
            </div>
            <button type="submit" class="btn btn-primary">Подтвердить</button>
        </form>
    </div>
</div>
@include('layout.footer')