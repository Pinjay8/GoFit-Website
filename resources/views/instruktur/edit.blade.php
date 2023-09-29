@extends('dashboard/layout')

@section ('title', 'Form Edit Instruktur')

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
    <form method="post" action="{{ url('dashboard/updateInstruktur/'.$instruktur->ID_INSTRUKTUR) }}"  enctype="multipart/form-data">
      @csrf
      @method ('PUT')
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold txt-title">Form Edit Instruktur</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="NAMA_INSTRUKTUR">Nama Instruktur</label>
                <input type="text" class="form-control" id="NAMA_INSTRUKTUR" name="NAMA_INSTRUKTUR" placeholder="Masukkan Nama Member" value="{{$instruktur->NAMA_INSTRUKTUR}}">
              </div>
              <div class="form-group">
                <label for="NO_TELPON_INSTRUKTUR">Nomor Telepon Instruktur</label>
                <input type="text" class="form-control" id="NO_TELPON_INSTRUKTUR" name="NO_TELPON_INSTRUKTUR" placeholder="Masukkan Nomor Telepon" value="{{$instruktur->NO_TELPON_INSTRUKTUR}}">
              </div>
              <div class="form-group">
                <label for="USIA_INSTRUKTUR">Usia Instruktur</label>
                <input type="text" class="form-control" id="USIA_INSTRUKTUR" name="USIA_INSTRUKTUR" placeholder="Masukkan Usia Member" value="{{$instruktur->USIA_INSTRUKTUR}}">
              </div>

              <div class="form-group">
                <label for="JENIS_KELAMIN_INSTRUKTUR">Jenis Kelamin Instruktur</label>
                <select name="JENIS_KELAMIN_INSTRUKTUR" class="form-control">
                  <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                  @if($instruktur->JENIS_KELAMIN_INSTRUKTUR == "Pria")
                    <option value="Pria" selected>Pria</option>
                  @else
                  <option value="Wanita">Wanita</option>
                  @endif

                  @if($instruktur->JENIS_KELAMIN_INSTRUKTUR == "Wanita")
                    <option value="Wanita" selected>Wanita</option>
                  @else
                    <option value="Pria">Pria</option>
                  @endif
                </select>
              </div>

              <div class="form-group">
                <label for="EMAIL_INSTRUKTUR">Email Member</label>
                <input type="text" class="form-control" id="EMAIL_INSTRUKTUR" name="EMAIL_INSTRUKTUR" placeholder="Masukkan Email Member" value="{{$instruktur->EMAIL_INSTRUKTUR}}">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="{{$instruktur->password}}">
              </div>
              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-warning">Edit</button>
              <a href="{{ url('dashboard/instruktur') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection