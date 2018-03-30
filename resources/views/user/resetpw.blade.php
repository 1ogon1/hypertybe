@include('layout.header')

<div class="row">
    <div class="col-sm-6">
        <h1>Востановление пароля</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <form action="{{ route('resetpw') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email">Email адресс</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                       placeholder="Введите email" required>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>

@include('layout.footer')