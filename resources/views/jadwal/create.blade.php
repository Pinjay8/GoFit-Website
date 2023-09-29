@extends('dashboard/layout')

@section ('title', 'Form Buat Jadwal Umum')

@section('main')
          {{-- @if($errors->any())
            <div class="alert alert-primary alert-dismissible" role="alert">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>
          @endif --}}
    <form method="post" action="{{ url('dashboard/storeJadwalUmum') }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold txt-title">Form Input Jadwal Umum</h6>
            </div>
            <div class="card-body">
              {{-- <div class="form-group">
                <label for="HARI_JADWAL_UMUM">Hari Jadwal Umum</label>
                <input type="text" class="form-control" id="NAMA_MEMBER" name="HARI_JADWAL_UMUM" placeholder="Masukkan Hari Jadwal Umum">
              </div> --}}

            <div class="form-group">
                <label for="HARI_JADWAL_UMUM">Pilih Hari Jadwal Umum</label>
                <select name="HARI_JADWAL_UMUM" class="form-control">
                   <option value="" hidden>Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
              </div>

              
              <div class="form-group">
                <label for="TANGGAL_JADWAL_UMUM">Tanggal Jadwal Umum</label>
                <input type="text" class="form-control" id="TANGGAL_JADWAL_UMUM" name="TANGGAL_JADWAL_UMUM" placeholder="Masukkan Tanggal Jadwal Umum">
              </div>

              <div class="form-group">
                <label for="ID_KELAS">Pilih Kelas</label>
                <select name="ID_KELAS" class="form-control">
                  <option slected hidden>Pilih Kelas</option>
                  @foreach($kelas as $dataKelas)
                    <option value="{{$dataKelas->ID_KELAS}}">{{$dataKelas->NAMA_KELAS}}</option>
                  @endforeach
                </select>
              </div>

               <div class="form-group">
                <label for="ID_INSTRUKTUR">Instruktur</label>
                <select name="ID_INSTRUKTUR" class="form-control">
                  <option selected hidden>Pilih Instruktur</option>
                  @foreach($instruktur as $dataInstruktur)
                    <option value="{{$dataInstruktur->ID_INSTRUKTUR}}">{{$dataInstruktur->NAMA_INSTRUKTUR}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="WAKTU_JADWAL_UMUM">Waktu Jadwal Umum</label>
                <input type="text" class="form-control" id="WAKTU_JADWAL_UMUM" name="WAKTU_JADWAL_UMUM" placeholder="Masukkan Waktu Jadwal Umum">
              </div>
              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ url('dashboard/jadwal') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection