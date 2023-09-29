@extends('layout/aplikasi')
@section('content')
        <div class="d-flex align-items-center justify-content-center" style="margin-top: 200px">
            <div class="col-md-6 d-none d-md-block p-0">
                <img src="{{ 'img/forgotImg.svg' }}"  alt="Gambar Lupa Sandi" style="width: 660px; height: 650px;background-color:#fb5b21">
            </div>
            <div class="col-md-5 p-0">
                <div class="card w-100" style="height: 650px;">
                    <h1 class="text-center p-3">Lupa Password</h1>
                    <div class="card-body">
                        <form action="{{url("storeForgotPassword")}}" method="POST">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                            @csrf
                            <div>
                                <label for="EMAIL_PEGAWAI" class="mb-2 fs-5 fw-bold">Email Address</label>
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <input type="text" placeholder="Email" id="EMAIL_PEGAWAI" class="form-control" name="EMAIL_PEGAWAI"
                                    autofocus value="{{ old('EMAIL_PEGAWAI')}}">
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
                            <div class="d-grid mx-auto mt-5 pointer rounded">
                                <button type="submit" class="btn btn-dark btn-block btn-lg"  style="background-color: #fb5b21; border:none">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection