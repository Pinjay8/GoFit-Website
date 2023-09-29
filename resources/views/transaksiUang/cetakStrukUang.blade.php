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
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-5">
                <img src="{{ asset('img/undraw_profile_2.svg') }}" class="h-50 w-75"alt="">
            </div>
            <div class="col-md-5">
                <div class="card h-75 bg-warning text-white">
                    <h4 class="text-center mb-0">Gofit</h4>
                    <div class="card-body">  
                        <h4 class="text-center"><b>Jl. Centralpark No.10 Yogyakarta</b></h4>
                        <hr style="border: 2px solid white; ">
                        <div class="mt-2">
                            <h3>Kuitansi</h3>
                            <h4>ID Member : {{$transaksiUang->member->ID_MEMBER}} / {{$transaksiUang->member->NAMA_MEMBER}}</h4>
                            <h4>Deposit : Rp. {{$transaksiUang->JUMLAH_DEPOSIT_UANG}}</h4>
                            <h4>Bonus Deposit : Rp.{{$transaksiUang->BONUS_DEPOSIT_UANG}}</h4>
                            <h4>Sisa Deposit : Rp.{{$transaksiUang->member->SISA_DEPOSIT_UANG}}</h4>
                            <h4>Total Deposit : Rp.{{$transaksiUang->TOTAL_DEPOSIT_UANG}}</h4>
                             <hr style="border: 2px solid white; ">
                            <h4>No Struk : {{$transaksiUang->ID_TRANSAKSI_UANG}}</h4>
                            <h4>Tanggal : {{$transaksiUang->TANGGAL_TRANSAKSI_UANG}}</h4>
                            <div class="d-flex justify-content-between">
                                <h4>Kasir : {{$transaksiUang->pegawai->ID_PEGAWAI}}/ {{$transaksiUang->pegawai->NAMA_PEGAWAI}}</h4>
                            </div>
                            <button class="btn buttonSubmit" style="position: absolute; right: 10" value="print" onclick="window.print()">Cetak Struk</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</main>
</div>

</body>
</html>


