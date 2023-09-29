<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>GOFIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion no-print" style="background-color: #fb5b21"
            id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ $user->ROLE_PEGAWAI }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <li class="nav-item active">
                <a href="{{ route('dashboard/main') }}" class="list-group-item list-group-item-action py-2 ripple"
                    aria-current="true">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span class="txt-title">Dashboard</span></a>
            </li>




            <!-- Divider -->
            <hr class="sidebar-divider" />

            @if ($user->ROLE_PEGAWAI == 'Admin')
                <a href="{{ url('dashboard/instruktur') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user-friends"></i>
                    <span class="ml-1 txt-title">Mengelola Instruktur</span>
                </a>
            @endif


            @if ($user->ROLE_PEGAWAI == 'Kasir')
                <a href="{{ url('dashboard/member') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user-friends"></i><span class="ml-1 txt-title">Mengelola Member</span>
                </a>
                <br>
                <a href="{{ url('dashboard/memberDeaktif') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user-friends"></i><span class="ml-1 txt-title">Mengelola Member Deaktif</span>
                </a>
                <br>
                <a href="{{ url('dashboard/resetKelas') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user-friends"></i><span class="ml-1 txt-title">Mengelola Reset Kelas</span>
                </a>
                <br>
                <a href="{{ url('dashboard/resetIzin') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user-friends"></i><span class="ml-1 txt-title">Mengelola Reset Izin</span>
                </a>
                <br>
                <a href="{{ url('dashboard/transaksiAktivasi') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-wallet"></i><span class="ml-1 txt-title">Transaksi Aktivasi</span>
                </a>
                <br>
                <a href="{{ url('dashboard/transaksiDepositUang') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-money-bill-wave-alt"></i><span class="ml-1 txt-title">Transaksi Deposit Uang</span>
                </a>

                <br>
                <a href="{{ url('dashboard/transaksiDepositKelas') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-wallet"></i><span class="ml-1 txt-title">Transaksi Deposit Kelas</span>
                </a>
                <br>
                <a href="{{ url('dashboard/presensiBookingKelas') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-wallet"></i><span class="ml-1 txt-title">Presensi Booking Kelas</span>
                </a>
                <br>
                <a href="{{ url('dashboard/presensiBookingGym') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-dumbbell"></i><span class="ml-1 txt-title">Presensi Booking Gym</span>
                </a>
            @endif


            @if ($user->ROLE_PEGAWAI == 'Manajer Operasional')
                <a href="{{ url('dashboard/jadwal') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-calendar-alt"></i><span class="ml-1 txt-title">Jadwal Kelas Umum</span>

                </a>
                <br>
                <a href="{{ url('dashboard/jadwalHarian') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="far fa-calendar-times"></i><span class="ml-1 txt-title">Jadwal Kelas Harian</span>
                    <br>
                </a>
                <br>
                <a href="{{ url('dashboard/izinInstruktur') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-check"></i><span class="ml-1 txt-title">Izin Instruktur</span>
                </a>
                <br>
                <a href="{{ url('dashboard/laporanPendapatan') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-money-check"></i></i><span class="ml-1 txt-title">Laporan Rekap Pendapatan</span>
                </a>
                <br>

                <a href="{{ url('dashboard/laporanAktivitasKelas') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fab fa-odnoklassniki"></i><span class="ml-1 txt-title">Laporan Aktivitas Kelas
                        Bulanan</span>
                </a>
                <br>

                <a href="{{ url('dashboard/laporanAktivitasGym') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-dumbbell"></i><span class="ml-1 txt-title">Laporan Aktivitas Gym Bulanan</span>

                </a>
                <br>
                <a href="{{ url('dashboard/laporanKinerjaInstruktur') }}"
                    class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-file"></i><span class="ml-1 txt-title">Laporan Kinerja Instruktur</span>
                    <br>
                </a>
            @endif

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->NAMA_PEGAWAI }}</>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('img/undraw_profile.svg') }}" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 txt-title"><span
                                            class="ml-1 txt-title">Profile</span></i>

                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 txt-title"><span
                                            class="ml-1 txt-title">Logout</span></i>

                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    </div>
                    @include('message')
                    @yield('main')
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
                    </script>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('footer-script')

</html>
