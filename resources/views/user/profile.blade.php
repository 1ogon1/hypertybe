@include('layout.header')
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <img src="{{$user->image}}" width="150" class="img-rounded">
        </div>
        @if ($_SESSION['user_id'] == $user->id)
            <form action="{{ route('update') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{--<input type="file" name="image"><br>--}}
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Browse&hellip; <input type="file" name="image" style="display: none;" accept="image/*">
                    </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" value="{{$user->name}}" name="name" id="name"
                           aria-describedby="name"
                           placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="surname" class="form-control" value="{{$user->surname}}" name="surname" id="surname"
                           aria-describedby="surname"
                           placeholder="Enter surname">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email"
                           aria-describedby="email"
                           placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                           aria-describedby="password"
                           placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @else
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control" value="{{$user->name}}" name="name" id="name"
                       aria-describedby="name"
                       placeholder="Enter name"
                       readonly>
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="surname" class="form-control" value="{{$user->surname}}" name="surname" id="surname"
                       aria-describedby="surname"
                       placeholder="Enter surname"
                       readonly>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email"
                       aria-describedby="email"
                       placeholder="Enter email"
                       readonly>
            </div>
        @endif
    </div>
</div>

@include('layout.footer')
<script type="text/javascript">
    $(function () {

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }
            });
        });
    });
</script>