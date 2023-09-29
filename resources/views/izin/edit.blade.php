@extends('dashboard/layout')

@section ('title', 'Form Konfirmasi Izin Instruktur')

@section('main')
    <form method="post" action="{{url('dashboard/updateIzin/'.$izin->ID_IZIN)}}"  enctype="multipart/form-data">
      @csrf
      @method ('PUT')
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold txt-title">Form Konfirmasi Instruktur</h6>
            </div>
            <div class="card-body">

               {{-- <div class="form-group">
                <label for="ID_INSTRUKTUR">Instruktur</label>
                <select name="ID_INSTRUKTUR" class="form-control">
                  <option hidden></option>
                  @foreach($instruktur as $dataInstruktur)
                    <option value="{{$dataInstruktur->ID_INSTRUKTUR}}">{{$dataInstruktur->NAMA_INSTRUKTUR}}</option>
                  @endforeach
                </select>
              </div> --}}

              <div class="form-group">
                <label for="ID_INSTRUKTUR">Nama Instruktur</label>
                <input type="text" class="form-control" id="ID_INSTRUKTUR" name="ID_INSTRUKTUR" placeholder="Masukkan Nama Instruktur" value="{{$izin->instruktur->NAMA_INSTRUKTUR}}" disabled>
              </div>

              <div class="form-group">
                <label for="STATUS_KONFIRMASI">Status Konfirmasi</label>
                <input type="text" class="form-control" id="STATUS_KONFIRMASI" name="STATUS_KONFIRMASI" placeholder="Masukkan Status Konfirmasi">
              </div>

              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ url('dashboard/izinInstruktur') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>


@endsection