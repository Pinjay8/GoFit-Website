@extends('dashboard/layout')

@section ('title', 'Form Laporan Pendapatan Bulanan dan Tahunan')


{{-- @section('main')
    <style>
        #table {
            background-color: white;
        }

        #graph {
            background-color: white;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #table,
            #table * {
                visibility: visible;
            }

            #graph,
            #graph * {
                visibility: visible;
            }
        }

        .underline {
            text-decoration: underline;
        }
    </style>

    <div class="input-group input-group-sm mb-2">
        <form action="{{ url('dashboard/laporanPendapatan') }}" method="GET" class="mb-3">
            <div class="input-group ms-4 w-100 d-flex flex-end">
                <input type="number" class="form-control" placeholder="Masukkan Tahun Yang Diinginkan" name="tahun" required >
                <button class="btn buttonSubmit" type="submit">Tampilkan</button>
            </div>
        </form>
    </div>


    <div class="container-fluid" id="table">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <button class="btn btn-primary float-right mx-3 mt-2" onclick="printTable()">
                                <span data-feather="edit">
                                    <i class="fas fa-print"></i>
                                </span>
                            </button>
                        <h2>GoFit</h2>
                        <p>Jl. Centralpark No. 10 Yogyakarta</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <h5 class="underline">LAPORAN PENDAPATAN BULANAN</h5>
                        @if (isset($tahun_transaksi_aktivasi) || isset($tahun_transaksi_deposit))
                            <p class="mb-1">PERIODE: {{ $tahun_transaksi_aktivasi }}</p>
                            <p>Tanggal cetak: {{ $tanggal_cetak }}</p>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Aktivasi</th>
                                            <th>Deposit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_per_tahun = 0;
                                            $total_per_bulan = [];
                                        @endphp
                                        @foreach ($bulan_transaksi as $index => $bulan)
                                            @php
                                                $total_transaksi_aktivasi_bulan = $total_transaksi_aktivasi[$index] ?? 0;
                                                $total_deposit_kelas = $total_transaksi_deposit_kelas[$bulan] ?? 0;
                                                $total_deposit_uang = $total_transaksi_deposit_uang[$bulan] ?? 0;
                                                $total_deposit = $total_deposit_kelas + $total_deposit_uang;
                                                $total_per_tahun += $total_transaksi_aktivasi_bulan + $total_deposit;
                                                
                                                if ($bulan === 'January') {
                                                    $total_per_bulan[0] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'February') {
                                                    $total_per_bulan[1] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'March') {
                                                    $total_per_bulan[2] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'April') {
                                                    $total_per_bulan[3] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'May') {
                                                    $total_per_bulan[4] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'June') {
                                                    $total_per_bulan[5] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'July') {
                                                    $total_per_bulan[6] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'August') {
                                                    $total_per_bulan[7] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'September') {
                                                    $total_per_bulan[8] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'October') {
                                                    $total_per_bulan[9] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'November') {
                                                    $total_per_bulan[10] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                } elseif ($bulan === 'Desember') {
                                                    $total_per_bulan[11] = $total_transaksi_aktivasi_bulan + $total_deposit;
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $bulan }}</td>
                                                <td>{{ number_format($total_transaksi_aktivasi[$index] ?? 0) }}</td>
                                                <td>{{ number_format($total_deposit) }}</td>
                                                <td>{{ number_format(($total_transaksi_aktivasi[$index] ?? 0) + $total_deposit) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end ">Total</th>
                                            <th>{{ number_format($total_per_tahun) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @elseif($tahun_transaksi_aktivasi === null)
                            <p>Silahkan masukkan tahun yang ingin ditampilkan datanya</p>
                        @else
                            <p>Tidak terdapat data yang tersedia untuk tahun yang dimasukkan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5" id="graph">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Grafik Pendapatan Bulanan</h2>
                        <button class="btn btn-info float-right " onclick="printGraph()">
                            <span data-feather="edit">
                                <i class="fas fa-print"></i>
                            </span>
                        </button>
                    </div>
                    @if (isset($tahun_transaksi_aktivasi))
                        <canvas id="pendapatanChart"></canvas>
                    @else
                        <p>Tidak terdapat data yang tersedia untuk tahun yang dimasukkan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('pendapatanChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May','June', 'July', 'August', 'September', 'October',
                    'November', 'Desember'
                ],
                datasets: [{
                    label: 'Total Pendapatan per Bulan',
                    backgroundColor: 'rgb(255, 99, 132)',
                    data: [{{ $total_per_bulan[0] ?? 0 }},
                        {{ $total_per_bulan[1] ?? 0 }},
                        {{ $total_per_bulan[2] ?? 0 }},
                        {{ $total_per_bulan[3] ?? 0 }},
                        {{ $total_per_bulan[4] ?? 0 }},
                        {{ $total_per_bulan[5] ?? 0 }},
                        {{ $total_per_bulan[6] ?? 0 }},
                        {{ $total_per_bulan[7] ?? 0 }},
                        {{ $total_per_bulan[8] ?? 0 }},
                        {{ $total_per_bulan[9] ?? 0 }},
                        {{ $total_per_bulan[10] ?? 0 }},
                        {{ $total_per_bulan[11] ?? 0 }}
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

            function printTable() {
                var graphContainer = document.getElementById('graph');
                graphContainer.style.display = 'none';
                window.print();
                graphContainer.style.display = 'block';
            }

            function printGraph() {
                var tableContainer = document.getElementById('table');
                tableContainer.style.display = 'none';
                window.print();
                tableContainer.style.display = 'block';
            }
         </script>
                 </div>
            </div>
        </div>
@endsection --}}



@section('main')
    <div class=" card my-5 p-3 rounded shadow-lg w-50 mx-auto no-print text-light" style="background-color: #fb5b21">
        <h3 class="card-title text-center">Filter Pada Laporan</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/laporanPendapatanProcess') }}" method="get" enctype="multipart/form-data">
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
    @if (
        !($data_activation && $data_depo_class && $data_total_income) &&
            !(Session::get('data_activation') && Session::get('data_depo_class') && Session::get('data_total_income')))
    @else
        @php
            $data_activation = Session::get('data_activation');
            $data_depo_class = Session::get('data_depo_class');
            $data_total_income = Session::get('data_total_income');

        @endphp
        <div class="card" style="background-color: #fb5b21; color:white">
            <div class="pb-3 ps-3 pe-3 pt-3 d-flex flex-row-reverse justify-content-between">
                <button type="button" class="btn bg-light text-black mt-2 no-print" onclick="window.print()" style="color: #fb5b21"> <i
                        class="fas fa-solid fa-print fa-fw me-3" style="color: #fb5b21"></i>Cetak</button>
                <h3 class="card-title">Laporan Pendapatan {{ Session::get('year') }}</h3>
            </div>
        </div>
        <!-- START DATA -->
        <div class=" card my-1 p-3 bg-body rounded shadow-sm mt-3">

            <h3>GoFit</h3>
            <p>Jl. Centralpark No.10 Yogyakarta</p>
            <h3>LAPORAN PENDAPATAN TAHUNAN</h3>
            <p>PERIODE: {{ Session::get('year') }}</p>
            <p>Tanggal cetak: {{ \Carbon\Carbon::now()->translatedformat('d M Y') }}</p>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-2">Bulan</th>
                        <th class="col-md-2">Transaksi Aktivasi</th>
                        <th class="col-md-2">Transaksi Deposit</th>
                        <th class="col-md-2">Total</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="col-md-2">January</td>
                        @if ($data_activation[0])
                            <td>{{ $data_activation[0][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[0])
                            <td class="col-md-2">
                                {{ $data_depo_class[0][0]->total_income_deposit }}
                            </td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[0])
                            <td class="col-md-2">{{ $data_total_income[0][0]->total_income }}</td>
                            @php
                                $temp_total_all = $data_total_income[0][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all = 0;
                            @endphp
                        @endif
                    </tr>

                    <tr>
                        <td class="col-md-2">February</td>
                        @if ($data_activation[1])
                            <td>{{ $data_activation[1][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[1])
                            <td class="col-md-2">{{ $data_depo_class[1][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[1])
                            <td class="col-md-2">{{ $data_total_income[1][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[1][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>

                    <tr>
                        <td class="col-md-2">March</td>
                        @if ($data_activation[2])
                            <td>{{ $data_activation[2][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[2])
                            <td class="col-md-2">{{ $data_depo_class[2][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[2])
                            <td class="col-md-2">{{ $data_total_income[2][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[2][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">April</td>
                        @if ($data_activation[3])
                            <td>{{ $data_activation[3][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[3])
                            <td class="col-md-2">{{ $data_depo_class[3][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[3])
                            <td class="col-md-2">{{ $data_total_income[3][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[3][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">May</td>
                        @if ($data_activation[4])
                            <td>{{ $data_activation[4][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[4])
                            <td class="col-md-2">{{ $data_depo_class[4][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[4])
                            <td class="col-md-2">{{ $data_total_income[4][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[4][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">June</td>
                        @if ($data_activation[5])
                            <td>{{ $data_activation[5][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[5])
                            <td class="col-md-2">{{ $data_depo_class[5][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[5])
                            <td class="col-md-2">{{ $data_total_income[5][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[5][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">July</td>
                        @if ($data_activation[6])
                            <td>{{ $data_activation[6][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[6])
                            <td class="col-md-2">{{ $data_depo_class[6][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[6])
                            <td class="col-md-2">{{ $data_total_income[6][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[6][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">August</td>
                        @if ($data_activation[7])
                            <td>{{ $data_activation[7][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[7])
                            <td class="col-md-2">{{ $data_depo_class[7][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[7])
                            <td class="col-md-2">{{ $data_total_income[7][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[7][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">September</td>
                        @if ($data_activation[8])
                            <td>{{ $data_activation[8][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[8])
                            <td class="col-md-2">{{ $data_depo_class[8][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[8])
                            <td class="col-md-2">{{ $data_total_income[8][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[8][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">October</td>
                        @if ($data_activation[9])
                            <td>{{ $data_activation[9][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[9])
                            <td class="col-md-2">{{ $data_depo_class[9][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[9])
                            <td class="col-md-2">{{ $data_total_income[9][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[9][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">November</td>
                        @if ($data_activation[10])
                            <td>{{ $data_activation[10][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[10])
                            <td class="col-md-2">{{ $data_depo_class[10][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[10])
                            <td class="col-md-2">{{ $data_total_income[10][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[10][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2">December</td>
                        @if ($data_activation[11])
                            <td>{{ $data_activation[11][0]->total_income_activation }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_depo_class[11])
                            <td class="col-md-2">{{ $data_depo_class[11][0]->total_income_deposit }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($data_total_income[11])
                            <td class="col-md-2">{{ $data_total_income[11][0]->total_income }}</td>
                            @php
                                $temp_total_all += $data_total_income[11][0]->total_income;
                            @endphp
                        @else
                            <td>0</td>
                            @php
                                $temp_total_all += 0;
                            @endphp
                        @endif
                    </tr>
                    <tr>
                        <td class="col-md-2 text-center" colspan="3">Total</td>
                        <td>{{ $temp_total_all }}</td>
                    </tr>
                </tbody>
            </table>
            {{-- <div>
            {{ $members->links('pagination::bootstrap-5') }}
        </div> --}}
        </div>

        <div class="card mt-5">
            <div class="card-body mr-5">
                <canvas id="myChart" height="100px"></canvas>
            </div>
        </div>
        {{-- <div class="card mt-5">
            <div class="card-body ms-5">
                <canvas id="myChart2" height="100px"></canvas>
            </div>
        </div> --}}
    @endif
@endsection

@section('footer-script')
    <script type="text/javascript">
        var year = {{ Session::get('year') }};
        var label = {{ Js::from(Session::get('report_keys')) }}
        var value = {{ Js::from(Session::get('report_value')) }}

        console.log(value)

        const data = {
            labels: label,
            datasets: [{
                label: 'Laporan Pendapatan Aktivasi Dan Deposit ' + year,
                backgroundColor: 'rgb(1, 81, 253)',
                borderColor: 'rgb(255,0,0)',
                borderWidth: 1,
                data: value,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {

            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection