@extends('dashboard/layout')

@section ('title', 'Form Edit Member')

@section('main')
    <form method="post" action="{{url('dashboard/updateMember/'.$member->ID_MEMBER)}}"  enctype="multipart/form-data">
      @csrf
      @method ('PUT')
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold txt-title">Form Edit Member</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="NAMA_MEMBER">Nama Member</label>
                <input type="text" class="form-control" id="NAMA_MEMBER" name="NAMA_MEMBER" placeholder="Masukkan Nama Member" value="{{$member->NAMA_MEMBER}}">
              </div>
              <div class="form-group">
                <label for="NO_TELPON_MEMBER">Nomor Telepon Member</label>
                <input type="text" class="form-control" id="NO_TELPON_MEMBER" name="NO_TELPON_MEMBER" placeholder="Masukkan Nomor Telepon" value="{{$member->NO_TELPON_MEMBER}}">
              </div>
              <div class="form-group">
                <label for="USIA_MEMBER">Usia Member</label>
                <input type="text" class="form-control" id="USIA_MEMBER" name="USIA_MEMBER" placeholder="Masukkan Usia Member" value="{{$member->USIA_MEMBER}}">
              </div>
              <div class="form-group">
                <label for="ALAMAT_MEMBER">Alamat Member</label>
                <input type="text" class="form-control" id="ALAMAT_MEMBER" name="ALAMAT_MEMBER" placeholder="Masukkan Alamat Member" value="{{$member->ALAMAT_MEMBER}}">
              </div>

              <div class="form-group">
                <label for="JENIS_KELAMIN_MEMBER">Jenis Kelamin Member</label>
                <select name="JENIS_KELAMIN_MEMBER" class="form-control">
                  <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                  @if($member->JENIS_KELAMIN_MEMBER == "Pria")
                    <option value="Pria" selected>Pria</option>
                  @else
                  <option value="Wanita">Wanita</option>
                  @endif

                  @if($member->JENIS_KELAMIN_MEMBER == "Wanita")
                    <option value="Wanita" selected>Wanita</option>
                  @else
                    <option value="Pria">Pria</option>
                  @endif
                </select>
              </div>

               <div class="form-group">
                <label for="TANGGAL_LAHIR_MEMBER">Tanggal Lahir Member</label>
                <input type="text" class="form-control" id="TANGGAL_LAHIR_MEMBER" name="TANGGAL_LAHIR_MEMBER" placeholder="Masukkan Tanggal Lahir Member" value="{{$member->TANGGAL_LAHIR_MEMBER}}">
              </div>

              <div class="form-group">
                <label for="EMAIL_MEMBER">Email Member</label>
                <input type="text" class="form-control" id="EMAIL_MEMBER" name="EMAIL_MEMBER" placeholder="Masukkan Email Member" value="{{$member->EMAIL_MEMBER}}">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="{{$member->password}}">
              </div>


              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-warning">Edit</button>
              <a href="{{ url('dashboard/member') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection