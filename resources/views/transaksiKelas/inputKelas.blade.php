<html>
<head>
    <title>GOFIT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        rel="stylesheet"
    />
    <link href="{{ asset('css/app.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" />
</head>
<body>

<div class="container">
<main class="login-form">
        @include("message")
        <form method="post" action="{{ url('dashboard/storeTransaksiKelas') }}"  enctype="multipart/form-data">
        @csrf
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-5">
                    <img src="{{ asset('img/undraw_profile_2.svg') }}" class="h-50 w-75"alt="">
                </div>
                <div class="col-md-5">
                    <div class="card h-75 bg-warning text-white">
                        <h3 class="text-center mb-0">Konfirmasi Pembayaran</h3>
                        <div class="card-body mb-0 p-2">  
                            <hr style="border: 2px solid white; margin-bottom:0px">
                            <div class="mt-2">
                                <h4>ID Member : {{$member->ID_MEMBER}} / {{$member->NAMA_MEMBER}}</h4>
                                <h4>Nama Member : {{$member->NAMA_MEMBER}}</h4>
                                <h4>Alamat : {{$member->ALAMAT_MEMBER}}</h4>
                                <hr style="border: 2px solid white; margin-bottom:0px">
                                <button type="submit" class="btn btn-success" style="position: absolute; right:20; bottom:10;">Submit</button>
                                <input type='text' class="form-control mb-3"name="ID_MEMBER"
                                    placeholder="Input date of birth member" autocomplete="off" value="{{ $member->ID_MEMBER }}"
                                    hidden />
                                <input type='text' class="form-control mb-3"name="ID_KELAS"
                                        placeholder="Input date of birth member" autocomplete="off" value="{{ $ID_KELAS }}"
                                        hidden />

                                <label class="font-weight-bold mb-2">Jumlah Deposit Kelas</label>
                                    <input type='number' class="form-control mb-3"name="JUMLAH_DEPOSIT" autocomplete="off"
                                        value="{{ $JUMLAH_DEPOSIT }}" readonly />

                                <label class="font-weight-bold mb-2">Date of Transaction</label>
                                <input type='text' class="form-control mb-3"name="TANGGAL_DEPOSIT_KELAS"
                                        placeholder="" autocomplete="off"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled />

                                <label class="font-weight-bold mb-2 mt-2">Jumlah Uang </label>
                                    <input type='text' class="form-control mb-3"name="JUMLAH_UANG" placeholder="Inputkan Uang Anda"
                                    autocomplete="off" />
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>
</main>
</div>

</body>
</html>


