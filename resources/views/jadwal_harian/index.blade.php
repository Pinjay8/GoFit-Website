@extends('dashboard/layout')

@section ('title', 'Data Jadwal Harian')

@section('main')
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold txt-title">Jadwal Harian</h5>
    </div>
      
        <div class="card">
          <div class="input-group">
            <form action="{{url('dashboard/searchJadwalHarian')}}" method="get" class="d-flex align-items-center">
                <input type="search" class="form-control" placeholder="Cari Jadwal Harian" aria-label="Nama Jadwal" aria-describedby="basic-addon2" name="keyword">
                <button class="btn buttonSubmit" type="submit">Cari</button>
            </form>
          </div>
        </div>

    <div class="card-body'">
      <a href="{{url("dashboard/creategenerateJadwalHarian")}}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Generate Jadwal</a>
      <div class="table-responsive">
        <div class="schedule-table">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
        <thead>
                <tr>
                  <th>Rutinitas</th>
                  <th colspan="12">Waktu</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                      <td>
                            @if ($tanggalHarian != null)
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->format('l') }}</div>
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->format('Y M d') }}</div>
                            @endif
                      </td>
                  @foreach($jadwalHarians as $jadwalHarian)
                    @if($jadwalHarian->jadwalUmum->HARI_JADWAL_UMUM == $tanggalHarian->TANGGAL_HARIAN->translatedformat('l'))
                    <td class="active">
                      <h4>{{ $jadwalHarian->TANGGAL_HARIAN->format('H:i:s') }}</h4>
                      <p>{{ $jadwalHarian->jadwalUmum->kelas->NAMA_KELAS }}</p>
                      <p>{{ $jadwalHarian->instruktur->NAMA_INSTRUKTUR }}</p>
                      <p>{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}</p>
                      <div class="d-flex justify-content-center">
                      <a href="{{url("dashboard/editJadwalHarian/". $jadwalHarian->TANGGAL_HARIAN)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                      </div>
                    </td>
                    @endif
                  @endforeach

                </tr>
                <tr>
                      <td>
                          @if ($tanggalHarian != null)
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(1)->format('l') }}</div>
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(1)->format('Y M d') }}</div>
                          @endif
                      </td>
                   @foreach($jadwalHarians as $jadwalHarian)
                    @if($jadwalHarian->jadwalUmum->HARI_JADWAL_UMUM == $tanggalHarian->TANGGAL_HARIAN->addDays(1)->translatedformat('l'))
                    <td class="active">
                      <h4>{{ $jadwalHarian->TANGGAL_HARIAN->format('H:i:s') }}</h4>
                      <p>{{ $jadwalHarian->jadwalUmum->kelas->NAMA_KELAS }}</p>
                      <p>{{ $jadwalHarian->instruktur->NAMA_INSTRUKTUR }}</p>
                      <p>{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}</p>
                      <div class="d-flex justify-content-center">
                      <a href="{{url("dashboard/editJadwalHarian/". $jadwalHarian->TANGGAL_HARIAN)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                      </div>
                    </td>
                    @endif
                  @endforeach
                </tr>
                <tr>
                  {{-- <td class="tanggalHarian">Rabu</td> --}}
                      <td>
                            @if ($tanggalHarian != null)
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(2)->format('l') }}</div>
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(2)->format('Y M d') }}</div>
                            @endif
                      </td>
                       @foreach($jadwalHarians as $jadwalHarian)
                          @if($jadwalHarian->jadwalUmum->HARI_JADWAL_UMUM == $tanggalHarian->TANGGAL_HARIAN->addDays(2)->translatedformat('l'))
                          <td class="active">
                            <h4>{{ $jadwalHarian->TANGGAL_HARIAN->format('H:i:s') }}</h4>
                            <p>{{ $jadwalHarian->jadwalUmum->kelas->NAMA_KELAS }}</p>
                            <p>{{ $jadwalHarian->instruktur->NAMA_INSTRUKTUR }}</p>
                            <p>{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}</p>
                            <div class="d-flex justify-content-center">
                            <a href="{{url("dashboard/editJadwalHarian/". $jadwalHarian->TANGGAL_HARIAN)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                            </div>
                          </td>
                          @endif
                  @endforeach
                </tr>
                <tr>
                  {{-- <td class="tanggalHarian">Kamis</td> --}}
                      <td>
                            @if ($tanggalHarian != null)
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(3)->format('l') }}</div>
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(3)->format('Y M d') }}</div>
                            @endif
                      </td>
                      @foreach($jadwalHarians as $jadwalHarian)
                          @if($jadwalHarian->jadwalUmum->HARI_JADWAL_UMUM == $tanggalHarian->TANGGAL_HARIAN->addDays(3)->translatedformat('l'))
                          <td class="active">
                            <h4>{{ $jadwalHarian->TANGGAL_HARIAN->format('H:i:s') }}</h4>
                            <p>{{ $jadwalHarian->jadwalUmum->kelas->NAMA_KELAS }}</p>
                            <p>{{ $jadwalHarian->instruktur->NAMA_INSTRUKTUR }}</p>
                            <p>{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}</p>
                            <div class="d-flex justify-content-center">
                            <a href="{{url("dashboard/editJadwalHarian/". $jadwalHarian->TANGGAL_HARIAN)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                            </div>
                          </td>
                          @endif
                      @endforeach
                </tr>
                <tr>
                  {{-- <td class="tanggalHarian">Jumat</td> --}}
                      <td>
                            @if ($tanggalHarian != null)
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(4)->format('l') }}</div>
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(4)->format('Y M d') }}</div>
                            @endif
                      </td>
                      @foreach($jadwalHarians as $jadwalHarian)
                          @if($jadwalHarian->jadwalUmum->HARI_JADWAL_UMUM == $tanggalHarian->TANGGAL_HARIAN->addDays(4)->translatedformat('l'))
                          <td class="active">
                            <h4>{{ $jadwalHarian->TANGGAL_HARIAN->format('H:i:s') }}</h4>
                            <p>{{ $jadwalHarian->jadwalUmum->kelas->NAMA_KELAS }}</p>
                            <p>{{ $jadwalHarian->instruktur->NAMA_INSTRUKTUR }}</p>
                            <p>{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}</p>
                            <div class="d-flex justify-content-center">
                            <a href="{{url("dashboard/editJadwalHarian/". $jadwalHarian->TANGGAL_HARIAN)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                            </div>
                          </td>
                          @endif
                      @endforeach
                </tr>
                <tr>
                  {{-- <td class="tanggalHarian">Sabtu</td> --}}
                      <td>
                            @if ($tanggalHarian != null)
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(5)->format('l') }}</div>
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(5)->format('Y M d') }}</div>
                            @endif
                      </td>
                       @foreach($jadwalHarians as $jadwalHarian)
                          @if($jadwalHarian->jadwalUmum->HARI_JADWAL_UMUM == $tanggalHarian->TANGGAL_HARIAN->addDays(5)->translatedformat('l'))
                          <td class="active">
                            <h4>{{ $jadwalHarian->TANGGAL_HARIAN->format('H:i:s') }}</h4>
                            <p>{{ $jadwalHarian->jadwalUmum->kelas->NAMA_KELAS }}</p>
                            <p>{{ $jadwalHarian->instruktur->NAMA_INSTRUKTUR }}</p>
                            <p>{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}</p>
                            <div class="d-flex justify-content-center">
                            <a href="{{url("dashboard/editJadwalHarian/". $jadwalHarian->TANGGAL_HARIAN)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                            </div>
                          </td>
                          @endif
                      @endforeach
                </tr>
                <tr>
                  {{-- <td class="tanggalHarian">Minggu</td> --}}
                      <td>
                            @if ($tanggalHarian != null)
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(6)->format('l') }}</div>
                                <div>{{ $tanggalHarian->TANGGAL_HARIAN->addDays(6)->format('Y M d') }}</div>
                            @endif
                      </td>
                       @foreach($jadwalHarians as $jadwalHarian)
                          @if($jadwalHarian->jadwalUmum->HARI_JADWAL_UMUM == $tanggalHarian->TANGGAL_HARIAN->addDays(6)->translatedformat('l'))
                          <td class="active">
                            <h4>{{ $jadwalHarian->TANGGAL_HARIAN->format('H:i:s') }}</h4>
                            <p>{{ $jadwalHarian->jadwalUmum->kelas->NAMA_KELAS }}</p>
                            <p>{{ $jadwalHarian->instruktur->NAMA_INSTRUKTUR }}</p>
                            <p>{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}</p>
                            <div class="d-flex justify-content-center">
                            <a href="{{url("dashboard/editJadwalHarian/". $jadwalHarian->TANGGAL_HARIAN)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                            </div>
                          </td>
                          @endif
                      @endforeach
                </tr>
              </tbody>
            
        </table>
      </div>
      </div>
    </div>
  </div>

@endsection