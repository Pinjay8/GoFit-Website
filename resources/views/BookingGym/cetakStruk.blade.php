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
                    <h3 class="text-center p-2">Struk Presensi Gym</h3>
                    <div class="card-body">  
                        <h1 class="text-center p-1">GoFit</h1>
                        <hr style="border: 2px solid white; ">
                        <div class="mt-5">
                            <div>
                            <h4>No Struk : {{ $booking_gym->KODE_BOOKING_GYM }}</h4>
                            @if($booking_gym->WAKTU_PRESENSI === null)
                                Belum Dikonfirmasi
                                @else
                                <h4>Tanggal Aktivasi : {{ \Carbon\Carbon::parse($booking_gym->WAKTU_PRESENSI)->format('d/m/Y H:i:s') }}</h4>
                            @endif

                            <h4>Status Presensi : {{ $booking_gym->STATUS_PRESENSI_GYM }}</h4>
                    </div>
                     <hr style="border: 2px solid white; ">
                </div>
                        <h4> <b> Member </b> : {{ $booking_gym->ID_MEMBER }} /
                            {{ $booking_gym->member->NAMA_MEMBER }} </h4>
                        <h4> Slot Waktu : {{ $booking_gym->SLOT_WAKTU }}</h4>
                                    <button style="position:absolute; right:40;" class="btn buttonSubmit mt-3 btn-lg" value="print" onclick="window.print()">Cetak Presensi</button>
            </div>
                        
                        </div>

                    </div>
                </div>
            </div>
    </div>
</main>
</div>

</body>
</html>


