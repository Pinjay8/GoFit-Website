@extends('dashboard/layout')

@section ('title', 'Form Presensi Booking Kelas')


@section('main')
         <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Presensi Booking Kelas</h6>
    </div>

    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Tanggal Kelas</th>
              <th>Tanggal Booking Kelas</th>
              <th>Tarif</th>
              <th>Waktu Presensi</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($presensi as $items)
              <tr>
                <th>{{ $items->KODE_BOOKING_KELAS }}</th>
                <td>{{ $items->member->NAMA_MEMBER }}</td>
                <td>{{ $items->TANGGAL_HARIAN }}</td>
                <td>{{ $items->TANGGAL_YANG_DIBOOKING_KELAS }}</td>
                <td>{{ $items->TARIF_KELAS }}</td>
                    @if ($items->WAKTU_PRESENSI != null)
                            <td class="col-md-3">{{ $items->WAKTU_PRESENSI }}</td>
                        @else
                            <td class="col-md-3">-</td>
                        @endif
                        @if ($items->STATUS_PRESENSI_KELAS != null)
                            <td class="col-md-1">{{ $items->STATUS_PRESENSI_KELAS }}</td>
                        @else
                            <td class="col-md-1">Belum dikonfirmasi</td>
                        @endif
                <td>
                  <div class="d-flex">
                    <a href="{{ url("dashboard/cetakStrukPresensiBooking/".$items->KODE_BOOKING_KELAS) }}" class="btn btn-info ml-1">Cetak Booking</a>
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