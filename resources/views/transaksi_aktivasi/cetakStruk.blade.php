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
                <img src="{{ asset('img/undraw_profile_3.svg') }}" class="h-50 w-75"alt="">
            </div>
            <div class="col-md-5">
                <div class="card h-75 bg-warning text-white" >
                    <h4 class="text-center mb-0"">Gofit</h4>
                    <div class="card-body">  
                        <h4 class="text-center">Jl. Centralpark No.10 Yogyakarta</h4>
                        <hr style="border: 2px solid white; ">
                        <div class="mt-2 mb-0">
                            <h4>Receipt</h4>
                            <h5>ID Member : {{$transaksiAktivasi->member->ID_MEMBER}} / {{$transaksiAktivasi->member->NAMA_MEMBER}}</h5>
                            <h5>Aktivasi Tahunan : Rp. {{$transaksiAktivasi->BIAYA_AKTIVASI}}</h5>
                            <h5>Masa Aktif Member : {{$transaksiAktivasi->member->MASA_AKTIVASI}}</h5>
                             <hr style="border: 2px solid white; ">
                            <h5>No Struk : {{$transaksiAktivasi->ID_TRANSAKSI_AKTIVASI}}</h5>
                            <h5>Tanggal : {{$transaksiAktivasi->TANGGAL_AKTIVASI}}</h5>
                            <h5>Kasir : {{$transaksiAktivasi->pegawai->ID_PEGAWAI}}/ {{$transaksiAktivasi->pegawai->NAMA_PEGAWAI}}</h5>
                            <h5>Kembalian : {{$transaksiAktivasi->KEMBALIAN}}</h5>
                            <button style="position:absolute; right:40;" class="btn buttonSubmit btn-lg" value="print" onclick="window.print()">Cetak Struk</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</main>
</div>

</body>
</html>


