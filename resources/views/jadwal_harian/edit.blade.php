@extends('dashboard/layout')

@section ('title', 'Form Edit Jadwal Harian')

@section('main')
    <form method="post" action="{{ url('dashboard/updateJadwalHarian/'.$jadwalHarian->TANGGAL_HARIAN) }}"  enctype="multipart/form-data">
      @csrf
      @method ('PUT')
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Edit Jadwal Umum</h6>
            </div>
            <div class="card-body">
            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Instruktur</label>
                    <select class="form-control" aria-label="Default select example" name="ID_INSTRUKTUR">
                        <option value="" hidden>Pilih Instruktur</option>
                        @foreach ($instruktur as $itemInstruktur)
                            <option value="{{ $itemInstruktur->ID_INSTRUKTUR }}"
                                {{ $jadwalHarian->ID_INSTRUKTUR == $itemInstruktur->ID_INSTRUKTUR ? 'selected' : '' }}>
                                {{ $itemInstruktur->NAMA_INSTRUKTUR }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Informasi</label>
                    <input type="text" class="form-control " name="STATUS_JADWAL_HARIAN"
                        value="{{ $jadwalHarian->STATUS_JADWAL_HARIAN }}" placeholder="Input member address"
                        autocomplete="off" />
                </div>
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