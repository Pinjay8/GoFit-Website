@extends('layout/aplikasi')
@section('content')

<main class="login-form">
        <div class="row">
            <div class="col-md-7 d-none d-md-block">
                <img src="{{ 'img/PicReset.svg' }}"  alt="Gambar Lupa Sandi" style="width: 900px;height: 650px">
            </div>
            <div class="col-md-5">
                <div class="card h-100">
                    <h1 class="text-center p-4">Ganti Password</h1>
                    <div class="card-body">
                        <form action="{{ url("updateForgotPassword/".$pegawai->ID_PEGAWAI)}}" method="POST"  enctype="multipart/form-data">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                            @csrf
                            @method ('PUT')
                            <div>
                                <label for="EMAIL_PEGAWAI" class="mb-2 fs-5 fw-bold">E-mail</label>
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <input type="text" placeholder="Email" id="EMAIL_PEGAWAI" class="form-control" name="EMAIL_PEGAWAI"
                                    autofocus value="{{$pegawai->EMAIL_PEGAWAI}}" disabled>
                                @error('EMAIL_PEGAWAI')
                                    is-invalid
                                @enderror
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-2x fa-envelope"></span>
                                    </div>
                                </div>
                                @error('EMAIL_PEGAWAI')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="mb-1 fs-5 fw-bold">Password Lama</label>
                                </div>
                            <div class="input-group mb-4 mt-3">
                                @error('password')
                                    is-invalid
                                @enderror
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-2x fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                              <div>
                                <label for="password" class="mb-1 fs-5 fw-bold">Password Baru</label>
                                </div>
                            <div class="input-group mb-4 mt-3">
                                @error('password')
                                    is-invalid
                                @enderror
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-2x fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid mx-auto mt-5 pointer rounded">
                                <button type="submit" class="btn btn-dark btn-block btn-lg"  style="background-color: #fb5b21; border:none">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</main>

@endsection