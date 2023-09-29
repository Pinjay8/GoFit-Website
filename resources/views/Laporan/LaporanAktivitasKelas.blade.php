@extends('dashboard/layout')

@section ('title', 'Form Laporan Aktivitas Kelas Bulanan')


@section('main')
    <div class=" card my-5 p-3  rounded shadow-lg w-50 mx-auto no-print text-light" style="background-color: #fb5b21">
        <h3 class="card-title text-center">Filter Pada Laporan</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/laporanAktivitasKelasProcess') }}" method="get" enctype="multipart/form-data">
            @csrf
            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Tahun</label>
                    <select class="form-control mb-3" aria-label="Default select example" name="year_filter">
                        <option value="" hidden>Pilih Tahun</option>
                        @php
                            $year = \Carbon\Carbon::now()->addYears(1);
                        @endphp
                        @for ($i = 0; $i < 3; $i++)
                            @php
                                $year->subYears(1);
                            @endphp
                            <option value={{ $year->format('Y') }}>
                                {{ $year->format('Y') }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Bulan</label>
                    <select class="form-control mb-3" aria-label="Default select example" name="month_filter">
                        <option value="" hidden>Pilih Bulan</option>
                        @php
                            $month = \Carbon\Carbon::create();
                        @endphp
                        @for ($i = 0; $i < 12; $i++)
                            <option value={{ $month->format('m') }}>
                                {{ $month->format('F') }}</option>
                            @php
                                $month->addMonth(1);
                            @endphp
                        @endfor
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label class="font-weight-bold mb-2">Manajer Operasional</label>
                    <input type='text' class="form-control mb-3"name="ID_PEGAWAI"
                        placeholder="Input date of birth member" autocomplete="off"
                        value="P{{ $user->ID_PEGAWAI }} / {{ $user->NAMA_PEGAWAI }}" disabled />
                </div>



                <button type="submit" class="btn bg-light btn-block mb-4" style="color: #fb5b21">Cari</button>
            </div>
        </form>
    </div>
    @if (!Session::get('print'))
        {{-- <div class="alert alert-danger">
            Data report not found. Please input month and year!
        </div> --}}
    @else
        @php
            $data_class_activity = Session::get('data_class_activity');
        @endphp
        <div class="card" style="background-color: #fb5b21; color:white">
            <div class="pb-3 ps-3 pe-3 pt-3 d-flex justify-content-between">
                <h3 class="card-title">Laporan Aktivitas Kelas {{ Session::get('year') }}</h3>
                @if ($data_class_activity)
                    <button type="button" class="btn bg-warning text-black mt-2 no-print" onclick="window.print()"> <i
                            class="fas fa-solid fa-print fa-fw me-3"></i>Cetak </button>
                @endif

            </div>
        </div>

        <div class=" card my-1 p-3 bg-body rounded shadow-sm mt-3">

            <h3>GoFit</h3>
            <p>Jl. Centralpark No.10 Yogyakarta</p>
            <h3>LAPORAN AKTIVITAS KELAS BULANAN</h3>
            <div class="d-flex">
                <p>BULAN: {{ \Carbon\Carbon::now()->month(Session::get('month'))->translatedformat('F') }} </p>
                <p class="ms-3">PERIODE: {{ Session::get('year') }}</p>
            </div>

            <p>Tanggal cetak: {{ \Carbon\Carbon::now()->translatedformat('d M Y') }}</p>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-2">Kelas</th>
                        <th class="col-md-2">Instruktur</th>
                        <th class="col-md-2">Jumlah Peserta</th>
                        <th class="col-md-2">Jumlah Libur</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data_class_activity as $item)
                        <tr>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->instruktur }}</td>
                            <td>{{ $item->jumlah_peserta_kelas }}</td>
                            <td>{{ $item->jumlah_libur }}</td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Laporan Aktivitas Kelas Tidak Tersedia
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{-- <div>
            {{ $members->links('pagination::bootstrap-5') }}
        </div> --}}
            {{-- </div>

        <div class="card mt-5">
            <div class="card-body mr-5">
                <canvas id="myChart" height="100px"></canvas>
            </div>
        </div> --}}
            {{-- <div class="card mt-5">
            <div class="card-body ms-5">
                <canvas id="myChart2" height="100px"></canvas>
            </div>
        </div> --}}
    @endif
@endsection