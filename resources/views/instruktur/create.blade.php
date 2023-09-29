@extends('dashboard/layout')

@section ('title', 'Form Buat Instruktur')

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
          {{-- @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success')}}
              </div>
          @endif --}}

    <form method="post" action="{{ url('dashboard/storeInstruktur') }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Input Instruktur</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="NAMA_INSTRUKTUR">Nama Instruktur</label>
                <input type="text" class="form-control" id="NAMA_INSTRUKTUR" name="NAMA_INSTRUKTUR" placeholder="Masukkan Nama Instruktur">
              </div>

              <div class="form-group">
                <label for="JENIS_KELAMIN_INSTRUKTUR">Jenis Kelamin Member</label>
                <select name="JENIS_KELAMIN_INSTRUKTUR" class="form-control">
                  <option hidden>Gender</option>
                  <option value="Pria">Pria</option>
                  <option value="Wanita">Wanita</option>
                </select>
              </div>

              <div class="form-group">
                <label for="USIA_INSTRUKTUR">Usia Instruktur</label>
                <input type="text" class="form-control" id="USIA_INSTRUKTUR" name="USIA_INSTRUKTUR" placeholder="Masukkan Usia Instruktur">
              </div>

              <div class="form-group">
                <label for="NO_TELPON_INSTRUKTUR">Nomor Telepon Instruktur</label>
                <input type="text" class="form-control" id="NO_TELPON_INSTRUKTUR" name="NO_TELPON_INSTRUKTUR" placeholder="Masukkan Nomor Telepon Instruktur">
              </div>

              <div class="form-group">
                <label for="EMAIL_INSTRUKTUR">Email Instruktur</label>
                <input type="text" class="form-control" id="EMAIL_INSTRUKTUR" name="EMAIL_INSTRUKTUR" placeholder="Masukkan Email Instruktur">
              </div>

              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ url('dashboard/instruktur') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection