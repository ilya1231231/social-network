@if (Session::has('info'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('info') }}
    </div>
@endif

@if (Session::has('decline'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('decline') }}
    </div>
@endif
