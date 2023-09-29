@extends('dashboard/layout')

@section ('title', 'Form Transaksi Aktivasi Tahunan')


@section('main')
         <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Transaksi Aktivasi</h6>
    </div>

    <div class="card-body">
      <a href="{{ url('dashboard/createTransaksiAktivasi')}}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Tambah Aktivasi</a>

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Member</th>
              <th>Nama Kasir</th>
              <th>Tanggal Transaksi</th>
              <th>Tanggal Kadaluarsa Transaksi</th>
              <th>Biaya Aktivasi</th>
              <th>Status</th>
              <th>Kembalian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksiAktivasi as $items)
              <tr>
                <th>{{ $items->ID_TRANSAKSI_AKTIVASI }}</th>
                <td>{{ $items->member->NAMA_MEMBER }}</td>
                <td>{{ $items->pegawai->NAMA_PEGAWAI }}</td>
                <td>{{ $items->TANGGAL_AKTIVASI }}</td>
                <td>{{ $items->TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI }}</td>
                <td>{{ $items->BIAYA_AKTIVASI }}</td>
                <td>{{ $items->STATUS }}</td>
                <td>{{ $items->KEMBALIAN }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ url("dashboard/cetakStruk/".$items->ID_TRANSAKSI_AKTIVASI) }}" class="btn btn-info ml-1">Cetak Kuitansi</a>
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