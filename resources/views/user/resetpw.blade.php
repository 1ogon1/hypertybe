@include('layout.header')

<div class="row">
    <div class="col-sm-6">
        <h1>Repairing password</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <form action="{{ route('resetpw') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                       placeholder="Enter email" required>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>

@include('layout.footer')