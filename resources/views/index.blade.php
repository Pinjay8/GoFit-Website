<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>GOFIT</title>

    <link rel="stylesheet" href="{{ 'css/app.css' }}">

    <!-- Favicon -->
    {{-- <link href="" rel="icon" /> --}}
    <link rel="icon" href="{{ 'img/logo.png' }}" type="image/png">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- {{-- Link Boostrap --}} -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body>
    {{-- Navbar --}}

    <header>

    </header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark px-lg-5">
        <div class="container">
            <a class="navbar-brand text-light "> <img src="{{ asset('img/logo.png') }}"
                    style="width: 50px; height: 50px; border-radius: 50%" class="img-fluid object-fit-cover me-1">
                <span">GOFIT</span>
            </a>
            <button class="navbar-toggler me-2 border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kelas">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>
                <div class="button-primary">
                    <a href="{{ route('login') }}" class="btn py-md-2 px-md-3 d-none d-lg-block">Masuk</a>
                </div>
                <div class="button-secondary ms-2">
                    <a href="{{ route('register') }}" class="btn py-md-2 px-md-3 d-none d-lg-block">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>
    {{-- Main --}}
    <div id="main" class="d-flex justify-content-center align-items-center">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white"> Salah Satu Gym Terbaik</h2>
                    <h1 class="text-white display-2">Ayo Bentuk Tubuhmu Di GOFIT</h1>
                    <button class="button-primary px-5 py-2 border-0 fs-5 text-white text-uppercase mt-3">Get
                        Info</button>
                </div>
            </div>
        </div>
    </div>
    </header>


    <section id="layanan" class="layanan">
        <div class="container">
            <div class="row py-5">
                <div class="col-12 text-center">
                    <h1>Layanan</h1>
                    <hr class="mx-auto d-block" style="border: 3px solid #fb5b21;; width: 40px">
                </div>
            </div>

            <div class="row gy-5 gy-lg-0">
                <div class="col-lg-3 order-lg-5 col-md-6 p-0">
                    <div class="img-service">
                        <img src="https://images.unsplash.com/photo-1546483875-ad9014c88eba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjN8fGd5bXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Gambar Layanan 1" class="img-fluid object-fit-cover">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-6 col-md-6 p-0 service-text ">
                    <div class=" p-3 text-center h-100 d-flex align-items-center flex-column justify-content-center">
                        <h4>Personal Training</h4>
                        <p class="lh-lg">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, ullam
                            quisquam labore earum molestiae ipsum!</p>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-3 col-md-6 p-0">
                    <div class="img-service">
                        <img src="https://images.unsplash.com/photo-1554284126-aa88f22d8b74?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDZ8fGd5bXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Gambar Layanan 1" class="img-fluid object-fit-cover">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-4 col-md-6 p-0 service-text">
                    <div class=" p-3 text-center h-100 d-flex align-items-center flex-column justify-content-center">
                        <h4>Group Fitness Class</h4>
                        <p class="lh-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, ullam
                            quisquam labore earum molestiae ipsum!</p>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-8 col-md-6 p-0">
                    <div class="img-service">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8ODF8fGd5bXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Gambar Layanan 1" class="img-fluid object-fit-cover">
                    </div>

                </div>
                <div class="col-lg-3 order-lg-7 col-md-6 p-0 service-text">
                    <div
                        class="service-text p-3 text-center h-100 d-flex align-items-center flex-column justify-content-center">
                        <h4>Body Building</h4>
                        <p class="lh-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, ullam
                            quisquam labore earum molestiae ipsum!</p>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-1 col-md-6 p-0">
                    <div class="img-service">
                        <img src="https://images.unsplash.com/photo-1623200216581-969d9479cf7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8ODR8fGd5bXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Gambar Layanan 1" class="img-fluid object-fit-cover">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-2 col-md-6 p-0 service-text">
                    <div class=" p-3 text-center h-100 d-flex align-items-center flex-column justify-content-center">
                        <h4>Strength Building</h4>
                        <p class="lh-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, ullam
                            quisquam labore earum molestiae ipsum!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="kelas" id="kelas">
        <div class="container">
            <div class="row py-5">
                <div class="col-12 text-center">
                    <h1>Kelas</h1>
                    <hr class="mx-auto d-block" style="border: 3px solid #fb5b21;; width: 40px">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-0">
                            <div class="card-img">
                                <img src="https://images.unsplash.com/photo-1625151936268-e1ffba534f20?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTAxfHxneW18ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60"
                                    alt="Gambar Kelas 1" class="img-fluid  w-100 object-fit-cover">
                            </div>
                            <div class="card-text px-4  py-3 bg-black text-white">
                                <h6>Strength</h6>
                                <h5 class="fw-bold mb-0">Weightlifting</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-0">
                            <div class="card-img">
                                <img src="https://images.unsplash.com/photo-1605235186583-a8272b61f9fe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8aW5kb29yJTIwY3ljbGluZ3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                                    alt="Gambar Kelas 1" class="img-fluid  w-100 object-fit-cover">
                            </div>
                            <div class="card-text px-4  py-3 bg-black text-white">
                                <h6>Cardio</h6>
                                <h5 class="fw-bold mb-0">Indoor Cycling</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-0">
                            <div class="card-img">
                                <img src="https://images.unsplash.com/photo-1520787315319-093ba0cb4631?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                    alt="Gambar Kelas 1" class="img-fluid  w-100 object-fit-cover">
                            </div>
                            <div class="card-text px-4  py-3 bg-black text-white">
                                <h6>Strength</h6>
                                <h5 class="fw-bold mb-0">Kettlebell Power</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-0">
                            <div class="card-img">
                                <img src="https://images.unsplash.com/photo-1601039834076-c41cf1766d4b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fG11YXl0aGFpfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60"
                                    alt="Gambar Kelas 1" class="img-fluid w-100 object-fit-cover">
                            </div>
                            <div class="card-text px-4  py-3 bg-black text-white">
                                <h6>Training</h6>
                                <h5 class="fw-bold mb-0">Muaythai</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-0">
                            <div class="card-img">
                                <img src="https://images.unsplash.com/flagged/photo-1574005280900-3ff489fa1f70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Ym94aW5nfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60"
                                    alt="Gambar Kelas 1" class="img-fluid w-100 object-fit-cover">
                            </div>
                            <div class="card-text px-4  py-3 bg-black text-white">
                                <h6>Training</h6>
                                <h5 class="fw-bold mb-0">Boxing</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="kontak" id="kontak">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-4">
                    <div class="kontak-item d-flex align-items-center justify-content-center">
                        <i class="bi bi-geo-alt-fill bi"></i>
                        <p class="mb-0">Tambak Bayan V Street.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="kontak-item  d-flex align-items-center justify-content-center">
                        <i class="bi bi-telephone-fill"></i>
                        <p class="mb-0">+62 123456789</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="kontak-item  d-flex align-items-center justify-content-center">
                        <i class="bi bi-envelope-open-fill"></i>
                        <p class="mb-0">Gofit@gmail.com</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer>
        <div class="container-fluid py-4 py-lg-0 px-5" style="background: #111111;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-lg-12">
                    <div class="py-lg-4 text-center">
                        <p class="text-secondary mb-0 fs-5">2022 &copy;<a class="text-light fw-bold" href="#">
                                GOFIT</a>. Created By Alvin Cennanda</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
    <script src="{{ 'js/main.js' }}"></script>
</body>

</html>
