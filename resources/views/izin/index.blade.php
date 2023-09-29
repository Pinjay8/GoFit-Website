@extends('dashboard/layout')

@section ('title', 'Form Izin Instruktur')


@section('main')
         <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Izin Instruktur</h6>
    </div>

    <div class="card-body">
      {{-- <a href="{{url("dashboard/createIzin")}}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Konfirmasi</a> --}}

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID Izin</th>
              <th>ID Instruktur</th>
              <th>Nama Instruktur</th>
              <th>Tanggal Izin</th>
              <th>Tanggal Pengajuan</th>
              <th>Keterangan Izin</th>
              <th>Tanggal Konfirmasi</th>
              <th>Status Konfirmasi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($izin as $items)
              <tr>
                <th>{{ $items->ID_IZIN }}</th>
                <td>{{ $items->instruktur->ID_INSTRUKTUR }}</td>
                <td>{{ $items->instruktur->NAMA_INSTRUKTUR }}</td>
                <td>{{ $items->TANGGAL_IZIN }}</td>
                <td>{{ $items->TANGGAL_PENGAJUAN }}</td>
                <td>{{ $items->KETERANGAN_IZIN }}</td>
                <td>{{ $items->TANGGAL_KONFIRMASI }}</td>
                <td>{{ $items->STATUS_KONFIRMASI }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{url("dashboard/editIzin/".$items->ID_IZIN)}}" class="btn btn-warning ml-1">Konfirmasi</a>
                  </div>
                 </td>
              </tr> 
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection