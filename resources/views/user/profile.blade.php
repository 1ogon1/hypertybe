@include('layout.header')
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <img src="{{$user->image}}" width="150" class="img-rounded">
        </div>
        @if ($_SESSION['user_id'] == $user->id)
            <form action="{{ route('update') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Выбрать&hellip; <input type="file" name="image" style="display: none;" accept="image/*">
                    </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="name" class="form-control" value="{{$user->name}}" name="name" id="name"
                           aria-describedby="name"
                           placeholder="Введите имя" required>
                </div>
                <div class="form-group">
                    <label for="surname">Фамилия</label>
                    <input type="surname" class="form-control" value="{{$user->surname}}" name="surname" id="surname"
                           aria-describedby="surname"
                           placeholder="Вваедите фамилию">
                </div>
                <div class="form-group">
                    <label for="email">Email адресс</label>
                    <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email"
                           aria-describedby="email"
                           placeholder="Введите email" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password"
                           aria-describedby="password"
                           placeholder="Введите пароль">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        @else
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="name" class="form-control" value="{{$user->name}}" name="name" id="name"
                       aria-describedby="name"
                       placeholder="Поле пустое"
                       readonly>
            </div>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input type="surname" class="form-control" value="{{$user->surname}}" name="surname" id="surname"
                       aria-describedby="surname"
                       placeholder="Поле пустое"
                       readonly>
            </div>
            <div class="form-group">
                <label for="email">Email адресс</label>
                <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email"
                       aria-describedby="email"
                       placeholder="Поле пустое"
                       readonly>
            </div>
        @endif
    </div>
</div>

@include('layout.footer')
<script type="text/javascript" src="{{URL::asset('js/userImage.js')}}"></script>