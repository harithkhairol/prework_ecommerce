@if(session('error'))
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        {{ $error }} <br>
        @endforeach
    </div>
@endif


@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('error') }}
    </div>
@endif