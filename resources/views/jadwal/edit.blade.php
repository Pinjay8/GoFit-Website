@extends('dashboard/layout')

@section ('title', 'Form Edit Jadwal Umum')

@section('main')
          @if($errors->any())
            <div class="alert alert-primary alert-dismissible" role="alert">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>
          @endif
    <form method="post" action="{{ url('dashboard/updateJadwalUmum/'.$jadwalUmum->ID_JADWAL_UMUM) }}"  enctype="multipart/form-data">
      @csrf
      @method ('PUT')
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Edit Jadwal Umum</h6>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label for="HARI_JADWAL_UMUM">Pilih Hari Jadwal Umum</label>
                <select name="HARI_JADWAL_UMUM" class="form-control">
                   <option value="" hidden>Pilih Hari</option>
                    @if($jadwalUmum->HARI_JADWAL_UMUM == 'Senin')
                    <option value="Senin" selected>Senin</option>
                    @elseif($jadwalUmum->HARI_JADWAL_UMUM == 'Selasa')
                    <option value="Selasa" selected>Selasa</option>
                    @elseif($jadwalUmum->HARI_JADWAL_UMUM == 'Rabu')
                    <option value="Rabu" selected>Rabu</option>
                    @elseif($jadwalUmum->HARI_JADWAL_UMUM == 'Kamis')
                    <option value="Kamis" selected>Kamis</option>
                    @elseif($jadwalUmum->HARI_JADWAL_UMUM == 'Jumat')
                    <option value="Jumat" selected>Jumat</option>
                    @elseif($jadwalUmum->HARI_JADWAL_UMUM == 'Sabtu')
                    <option value="Sabtu" selected>Sabtu</option>
                    @elseif($jadwalUmum->HARI_JADWAL_UMUM == 'Minggu')
                    <option value="Minggu" selected>Minggu</option>
                    @endif
                </select>
              </div>

            <div class="form-group">
                <label for="TANGGAL_JADWAL_UMUM">Tanggal Jadwal Umum</label>
                <input type="text" class="form-control" id="TANGGAL_JADWAL_UMUM" name="TANGGAL_JADWAL_UMUM" placeholder="Masukkan Tanggal Jadwal Umum" value="{{$jadwalUmum->TANGGAL_JADWAL_UMUM}}">
              </div>

             <div class="form-group">
                <label for="ID_KELAS">Pilih Kelas</label>
                <select name="ID_KELAS" class="form-control">
                  <option hidden></option>
                  @foreach($kelas as $dataKelas)
                    <option value="{{$dataKelas->ID_KELAS}}"
                    {{$jadwalUmum->ID_KELAS == $dataKelas->ID_KELAS ? 'selected' : ''}}>{{$dataKelas->NAMA_KELAS}}</option>
                  @endforeach
                </select>
              </div>

            <div class="form-group">
                <label for="ID_INSTRUKTUR">Instruktur</label>
                <select name="ID_INSTRUKTUR" class="form-control">
                  <option hidden></option>
                  @foreach($instruktur as $dataInstruktur)
                    <option value="{{$dataInstruktur->ID_INSTRUKTUR}}"
                        {{$jadwalUmum->ID_INSTRUKTUR == $dataInstruktur->ID_INSTRUKTUR ? 'selected' : ''}}>
                        {{$dataInstruktur->NAMA_INSTRUKTUR}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="WAKTU_JADWAL_UMUM">Waktu Jadwal Umum</label>
                <input type="text" class="form-control" id="WAKTU_JADWAL_UMUM" name="WAKTU_JADWAL_UMUM" placeholder="Masukkan Waktu Jadwal Umum" value="{{$jadwalUmum->WAKTU_JADWAL_UMUM}}">
              </div>

              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-warning">Edit</button>
              <a href="{{ url('dashboard/jadwal') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection