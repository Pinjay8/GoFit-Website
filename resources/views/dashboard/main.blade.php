@extends('dashboard/layout')

@section('title', 'Dashboard')

@section('main')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row ">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title fw-bold">Dashboard</h5>
                <p class="mb-4">
                  Selamat Datang di Website GOFIT
                </p>
                <p style="text-align: justify">GOFIT adalah tempat yang didesain khusus untuk melakukan latihan dan olahraga. Di dalam gym biasanya terdapat berbagai jenis alat olahraga seperti treadmill, dumbbell, barbel, alat beban, alat latihan kardio, dan sebagainya. Fasilitas gym ini biasanya diperuntukkan bagi orang yang ingin meningkatkan kebugaran tubuh, membangun massa otot, menurunkan berat badan, atau meningkatkan kesehatan secara umum. Gym bisa menjadi tempat yang ideal bagi mereka yang ingin berolahraga dalam lingkungan yang terkontrol dan aman. Dalam gym, pengunjung juga dapat memperoleh bimbingan dari pelatih atau instruktur olahraga yang sudah berpengalaman dan terlatih untuk membantu mereka mencapai tujuan olahraga mereka. Ada berbagai jenis gym yang tersedia, mulai dari gym yang ditujukan untuk olahraga umum hingga gym yang lebih khusus seperti gym untuk binaragawan, yoga, atau Pilates. Gofit bahkan menawarkan fasilitas tambahan seperti kolam renang, sauna, spa, dan kafe.</p>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left mb-5">
              <div class="card-body d-flex justify-content-center align-items-center">
                <img
                  src="{{ '../img/undraw_rocket.svg' }}"
                  height="140"
                  alt="View Badge User"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection