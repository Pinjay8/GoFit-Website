@if ($errors->any())
    <div class="alert alert-danger alert-dismissible animate_animated animate_fadeInDown  no-print" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible animate_animated animate_fadeInDown no-print" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



@if (Session::get('error'))
    <div class="alert alert-danger alert-dismissible animate_animated animate_fadeInDown no-print" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif