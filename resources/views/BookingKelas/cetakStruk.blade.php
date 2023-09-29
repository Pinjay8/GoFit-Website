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
                <img src="{{ asset('img/undraw_profile_1.svg') }}" class="h-50 w-75"alt="">
            </div>
            <div class="col-md-5">
                <div class="card h-50 bg-warning text-white">
                    <h3 class="text-center p-2">Struk Presensi Kelas</h3>
                    <div class="card-body">  
                        <h1 class="text-center p-1">GoFit</h1>
                        <hr style="border: 2px solid white; ">
                        <div class="mt-5">
                           <h4>No Struk: {{ $presensi->KODE_BOOKING_KELAS }} </h4>
                @if ($presensi->WAKTU_PRESENSI != null)
                    <p>Tanggal :
                        {{ \Carbon\Carbon::parse($presensi->WAKTU_PRESENSI)->format('d/m/Y H:i:s') }}
                    </p>
                @else
                    <p>Tanggal : Belum dikonfirmasi </p>
                @endif

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <p>Member : {{ $presensi->ID_MEMBER }} / {{ $presensi->NAMA_MEMBER }}</p>
                <p>Kelas : {{ $presensi->NAMA_KELAS }}</p>
                <p>Instruktur : {{ $presensi->NAMA_INSTRUKTUR }}</p>
                @if ($presensi->TARIF_KELAS != 1)
                    <p>Tarif : Rp.{{ $presensi->TARIF_KELAS }}</p>
                    <p>Sisa deposit : Rp.{{ $presensi->SISA_DEPOSIT_KELAS }}</p>
                @else
                    <p>Sisa Deposit: {{ $presensi2->SISA_DEPO }}</p>
                    <p>Berlaku Sampai: {{ \Carbon\Carbon::parse($presensi2->MASA_BERLAKU)->format('d/m/Y H:i:s') }}</p>
                @endif
                        </div>
                        <button style="position:absolute; right:40;" class="btn buttonSubmit mt-3 btn-lg" value="print" onclick="window.print()">Cetak Presensi</button>
                    </div>
                </div>
            </div>
    </div>
</main>
</div>

</body>
</html>


