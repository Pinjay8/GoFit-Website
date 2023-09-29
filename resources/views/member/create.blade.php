@extends('dashboard/layout')

@section ('title', 'Form Create Member')

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
    <form method="post" action="{{ url('dashboard/storeMember') }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold txt-title">Form Input Member</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="NAMA_MEMBER">Nama Member</label>
                <input type="text" class="form-control" id="NAMA_MEMBER" name="NAMA_MEMBER" placeholder="Masukkan Nama Member">
              </div>
              <div class="form-group">
                <label for="NO_TELPON_MEMBER">Nomor Telepon</label>
                <input type="text" class="form-control" id="NO_TELPON_MEMBER" name="NO_TELPON_MEMBER" placeholder="Masukkan Nomor Telepon">
              </div>
              <div class="form-group">
                <label for="USIA_MEMBER">Usia Member</label>
                <input type="text" class="form-control" id="USIA_MEMBER" name="USIA_MEMBER" placeholder="Masukkan Usia Member">
              </div>
              <div class="form-group">
                <label for="ALAMAT_MEMBER">Alamat Member</label>
                <input type="text" class="form-control" id="ALAMAT_MEMBER" name="ALAMAT_MEMBER" placeholder="Masukkan Alamat Member">
              </div>

              <div class="form-group">
                <label for="JENIS_KELAMIN_MEMBER">Jenis Kelamin Member</label>
                <select name="JENIS_KELAMIN_MEMBER" class="form-control">
                  <option hidden>Gender</option>
                  <option value="Pria">Pria</option>
                  <option value="Wanita">Wanita</option>
                </select>
              </div>

              <div class="form-group">
                {{-- <div class="input-group date" id="datepicker"></div> --}}
                <label for="TANGGAL_LAHIR_MEMBER">Tanggal Lahir Member</label>
                <input type="text" class="form-control" id="TANGGAL_LAHIR_MEMBER" name="TANGGAL_LAHIR_MEMBER" placeholder="Masukkan Tanggal Lahir Member">
                {{-- <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span> --}}
              </div>

              <div class="form-group">
                <label for="EMAIL_MEMBER">Email Member</label>
                <input type="text" class="form-control" id="EMAIL_MEMBER" name="EMAIL_MEMBER" placeholder="Masukkan Email Member">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Email Member">
              </div>
              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ url('dashboard/member') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection