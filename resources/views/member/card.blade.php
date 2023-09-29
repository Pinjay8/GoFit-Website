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
                    <h1 class="text-center p-2">Card Member</h1>
                    <div class="card-body">  
                        <h1 class="text-center p-1">GoFit</h1>
                        <hr style="border: 2px solid white; ">
                        <div class="mt-5">
                            <h4 >ID Member : {{$member->ID_MEMBER}}</h4>
                            <h4>Nama Member : {{$member->NAMA_MEMBER}}</h4>
                            <h4>Alamat : {{$member->ALAMAT_MEMBER}}</h4>
                            <h4>Nomor Telepon : {{$member->NO_TELPON_MEMBER}}</h4>
                        </div>
                        <button style="position:absolute; right:40;" class="btn buttonSubmit mt-3 btn-lg" value="print" onclick="window.print()">Cetak Member</button>
                    </div>
                </div>
            </div>
    </div>
</main>
</div>

</body>
</html>


