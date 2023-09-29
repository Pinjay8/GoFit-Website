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
            <div class="col-md-6">
                <div class="card h-75 bg-warning text-white">
                    <h3 class="text-center "><b>Gofit </b></h3>
                    <div class="card-body">  
                        <h3 class="text-center">Jl. Centralpark No.10 Yogyakarta</h3>
                        <hr style="border: 1px solid white; ">
                        <div class="mt-2">
                            <h4>Kuitansi</h4>
                            <h4>ID Member : {{$transaksiKelas->member->ID_MEMBER}} / {{$transaksiKelas->member->NAMA_MEMBER}}</h4>
                            <h4>Deposit :  {{$transaksiKelas->JUMLAH_DEPOSIT}}</h4>
                            <h4>Jenis Kelas : {{$transaksiKelas->kelas->NAMA_KELAS}}</h4>
                            <h4>Total Deposit {{$transaksiKelas->kelas->NAMA_KELAS}} : {{$transaksiKelas->TOTAL_DEPOSIT_KELAS}}</h4>
                            <h4>Berlaku Sampai Dengan : {{$transaksiKelas->MASA_BERLAKU_KELAS}}</h4>
                             <hr style="border: 1px solid white; ">
                            <h4>No Struk : {{$transaksiKelas->ID_TRANSAKSI_KELAS}}</h4>
                            <h4>Tanggal : {{$transaksiKelas->TANGGAL_TRANSAKSI_KELAS}}</h4>
                            <div class="d-flex justify-content-between">
                                <h4>Kasir : {{$transaksiKelas->pegawai->ID_PEGAWAI}}/ {{$transaksiKelas->pegawai->NAMA_PEGAWAI}}</h4>
                            </div>
                            <button class="btn buttonSubmit"  style="position: absolute; right: 10"  value="print" onclick="window.print()">Cetak Struk</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</main>
</div>

</body>
</html>


