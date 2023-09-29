@extends('dashboard/layout')

@section ('title', 'Data Jadwal Umum')

@section('main')
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold txt-title">Jadwal Umum</h5>
    </div>
      
        {{-- <div class="card">
          <div class="input-group">
            <form action="" method="get" class="d-flex align-items-center">
                <input type="search" class="form-control" placeholder="Cari Jadwal Umum" aria-label="Nama Jadwal" aria-describedby="basic-addon2" name="keyword">
                <button class="btn buttonSubmit" type="submit">Cari</button>
            </form>
          </div>
        </div> --}}

    <div class="card-body'">
      <a href="{{ url('dashboard/createJadwalUmum') }}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Tambah Jadwal</a>
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
                  <td class="day">Senin</td>
                  @foreach($jadwals as $jadwalUmum)
                    @if($jadwalUmum->HARI_JADWAL_UMUM == 'Senin')
                    <td class="active">
                      <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                      <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                      <p>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</p>
                      <div class="d-flex justify-content-center">
                        <a href="{{ url("dashboard/editJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                        <form action="{{ url("dashboard/destroyJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM) }}" method="POST">
                        @csrf
                        @method('DELETE')
                          <button type="submit" class="btn btn-danger d-inline  mt-2">Hapus</button>
                      </form>
                      </div>
                      {{-- <div class="hover">
                        <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                        <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                        <span>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</span>
                      </div> --}}
                    </td>
                    @endif
                  @endforeach
                </tr>
                <tr>
                  <td class="day">Selasa</td>
                    @foreach($jadwals as $jadwalUmum)
                      @if($jadwalUmum->HARI_JADWAL_UMUM == 'Selasa')
                      <td class="active">
                        <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                        <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                        <p>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR}}</p>
                        <div class="d-flex justify-content-center">
                          <a href="{{ url("dashboard/editJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                          <form action="{{ url("dashboard/destroyJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger d-inline  mt-2">Hapus</button>
                        </form>
                        </div>
                        {{-- <div class="hover">
                          <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                          <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                          <span>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</span>
                        </div> --}}
                      </td>
                      @endif
                  @endforeach
                </tr>
                <tr>
                  <td class="day">Rabu</td>
                  @foreach($jadwals as $jadwalUmum)
                      @if($jadwalUmum->HARI_JADWAL_UMUM == 'Rabu')
                      <td class="active">
                        <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                        <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                        <p>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR}}</p>
                        <div class="d-flex justify-content-center">
                          <a href="{{ url("dashboard/editJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                          <form action="{{ url("dashboard/destroyJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger d-inline  mt-2">Hapus</button>
                        </form>
                        </div>
                        {{-- <div class="hover">
                          <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                          <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                          <span>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</span>
                        </div> --}}
                      </td>
                      @endif
                  @endforeach
                </tr>
                <tr>
                  <td class="day">Kamis</td>
                  @foreach($jadwals as $jadwalUmum)
                      @if($jadwalUmum->HARI_JADWAL_UMUM == 'Kamis')
                      <td class="active">
                        <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                        <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                        <p>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR}}</p>
                        <div class="d-flex justify-content-center">
                          <a href="{{ url("dashboard/editJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                          <form action="{{ url("dashboard/destroyJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger d-inline  mt-2">Hapus</button>
                        </form>
                        </div>
                        {{-- <div class="hover">
                          <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                          <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                          <span>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</span>
                        </div> --}}
                      </td>
                      @endif
                  @endforeach
                </tr>
                <tr>
                  <td class="day">Jumat</td>
                    @foreach($jadwals as $jadwalUmum)
                      @if($jadwalUmum->HARI_JADWAL_UMUM == 'Jumat')
                      <td class="active">
                        <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                        <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                        <p>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR}}</p>
                        <div class="d-flex justify-content-center">
                          <a href="{{ url("dashboard/editJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                          <form action="{{ url("dashboard/destroyJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger d-inline  mt-2">Hapus</button>
                        </form>
                        </div>
                        {{-- <div class="hover">
                          <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                          <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                          <span>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</span>
                        </div> --}}
                      </td>
                      @endif
                  @endforeach
                </tr>
                <tr>
                  <td class="day">Sabtu</td>
                    @foreach($jadwals as $jadwalUmum)
                      @if($jadwalUmum->HARI_JADWAL_UMUM == 'Sabtu')
                      <td class="active">
                        <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                        <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                        <p>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR}}</p>
                        <div class="d-flex justify-content-center">
                          <a href="{{ url("dashboard/editJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                          <form action="{{ url("dashboard/destroyJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger d-inline  mt-2">Hapus</button>
                        </form>
                        </div>
                        {{-- <div class="hover">
                          <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                          <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                          <span>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</span>
                        </div> --}}
                      </td>
                      @endif
                  @endforeach
                </tr>
                <tr>
                  <td class="day">Minggu</td>
                    @foreach($jadwals as $jadwalUmum)
                      @if($jadwalUmum->HARI_JADWAL_UMUM == 'Minggu')
                      <td class="active">
                        <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                        <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                        <p>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR}}</p>
                        <div class="d-flex justify-content-center">
                          <a href="{{ url("dashboard/editJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM)}}" class="btn btn-warning mr-1 ml-3 mt-2">Edit</a>
                          <form action="{{ url("dashboard/destroyJadwalUmum/".$jadwalUmum->ID_JADWAL_UMUM) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger d-inline  mt-2">Hapus</button>
                        </form>
                        </div>
                        {{-- <div class="hover">
                          <h4>{{ $jadwalUmum->WAKTU_JADWAL_UMUM }}</h4>
                          <p>{{ $jadwalUmum->kelas->NAMA_KELAS }}</p>
                          <span>{{ $jadwalUmum->instruktur->NAMA_INSTRUKTUR }}</span>
                        </div> --}}
                      </td>
                      @endif
                  @endforeach
                </tr>
              </tbody>
            
        </table>
        {{-- {{ $jadwals->links('pagination::bootstrap-5') }} --}}
      </div>
      </div>
    </div>
  </div>

@endsection