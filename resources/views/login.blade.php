@extends('layout/aplikasi')
@section('content')
    <div class="d-flex align-items-center justify-content-center" style="margin-top: 200px">
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="{{ 'img/PicLogin.svg' }}" class="rounded" style="width:660px; height: 650px; background-color:#fb5b21"
                alt="Gambar Login">
        </div>
        <div class="col-md-5 p-0">
            <div class="card w-100" style="height: 650px;">
                <h1 class="text-center p-3">Login</h1>
                <div class="card-body">
                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
                        <div>
                            <label for="EMAIL_PEGAWAI" class="mb-2 fs-5 fw-bold">Email Address</label>
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <input type="text" placeholder="Email" id="EMAIL_PEGAWAI" class="form-control"
                                name="EMAIL_PEGAWAI" autofocus>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-2x fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="Password" class="mb-1 fs-5 fw-bold">Password</label>
                        </div>
                        <div class="input-group mb-4 mt-3">
                            <input type="password" placeholder="Password" id="password" class="form-control"
                                name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-2x fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mx-auto mt-5 pointer rounded" style="width: fit-content">
                            <a href="{{ url('forgotPassword') }}"
                                style="text-decoration: none; color:white; cursor:pointer; background-color:#fb5b21; transition: 0.3s; "
                                class="btn">Lupa kata sandi?</a>
                        </div>

                        <div class="d-grid mx-auto mt-5 pointer rounded">
                            <button type="submit" class="btn btn-dark btn-block btn-lg"
                                style="background-color: #fb5b21; border:none">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
