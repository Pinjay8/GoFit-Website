@extends('dashboard/layout')

@section ('title', 'Form Presensi Booking Gym')


@section('main')

      <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Data Booking Gym</h6>
    </div>

    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Slot Waktu</th>
              <th>Tanggal Gym</th>
              <th>Tanggal Booking Gym</th>
              <th>Waktu Presensi</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($booking_gym as $items)
              <tr>
                <th>{{ $items->KODE_BOOKING_GYM }}</th>
                <td>{{ $items->member->NAMA_MEMBER }}</td>
                <td>{{ $items->SLOT_WAKTU}}</td>
                <td>{{ $items->TANGGAL_YANG_DIBOOKING_GYM }}</td>
                <td>{{ $items->TANGGAL_BOOKING_GYM }}</td>
                    @if ($items->WAKTU_PRESENSI != null)
                            <td class="col-md-3">{{ $items->WAKTU_PRESENSI }}</td>
                        @else
                            <td class="col-md-3">-</td>
                        @endif
                        @if ($items->STATUS_PRESENSI_GYM != null)
                            <td class="col-md-1">{{ $items->STATUS_PRESENSI_GYM }}</td>
                        @else
                            <td class="col-md-1">Belum dikonfirmasi</td>
                        @endif
                <td>
                  <div class="d-flex">
                    <a href="{{ url("dashboard/konfirmasiGym/".$items->KODE_BOOKING_GYM) }}" class="btn btn-info ml-1">Konfirmasi</a>
                  </div>
                </td>
              </tr> 
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>

         <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Data Booking Gym</h6>
    </div>

    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Slot Waktu</th>
              <th>Tanggal Gym</th>
              <th>Tanggal Booking Gym</th>
              <th>Waktu Presensi</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($booking_gym_after as $items)
              <tr>
                <th>{{ $items->KODE_BOOKING_GYM }}</th>
                <td>{{ $items->member->NAMA_MEMBER }}</td>
                <td>{{ $items->SLOT_WAKTU}}</td>
                <td>{{ $items->TANGGAL_YANG_DIBOOKING_GYM }}</td>
                <td>{{ $items->TANGGAL_BOOKING_GYM }}</td>
                    @if ($items->WAKTU_PRESENSI != null)
                            <td class="col-md-3">{{ $items->WAKTU_PRESENSI }}</td>
                        @else
                            <td class="col-md-3">-</td>
                        @endif
                        @if ($items->STATUS_PRESENSI_GYM != null)
                            <td class="col-md-1">{{ $items->STATUS_PRESENSI_GYM }}</td>
                        @else
                            <td class="col-md-1">Belum dikonfirmasi</td>
                        @endif
                <td>
                  <div class="d-flex">
                    <a href="{{ url("dashboard/cetakStrukPresensiGym/".$items->KODE_BOOKING_GYM) }}" class="btn btn-info ml-1">Cetak Booking</a>
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