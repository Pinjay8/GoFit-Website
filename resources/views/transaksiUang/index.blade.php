@extends('dashboard/layout')

@section ('title', 'Form Transaksi Deposit Uang')


@section('main')
         <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Transaksi Deposit Uang</h6>
    </div>

    <div class="card-body">
      <a href="{{ url('dashboard/createTransaksiUang')}}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Generate Deposit Uang </a>

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Member</th>
              <th>Nama Pegawai</th>
              <th>Nama Promo</th>
              <th>Tanggal Deposit Uang</th>
              <th>Jumlah Deposit</th>
              <th>Bonus Deposit</th>
              <th>Sisa Deposit Uang</th>
              <th>Total Deposit</th>
              <th>Kembalian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksiUang as $items)
              <tr>
                <th>{{ $items->ID_TRANSAKSI_UANG }}</th>
                <td>{{ $items->member->NAMA_MEMBER }}</td>
                <td>{{ $items->pegawai->NAMA_PEGAWAI }}</td>
                @if ($items->ID_PROMO != null)
                            <td class="col-md-1">{{ $items->promo->JENIS_PROMO }}</td>
                        @else
                            <td class="col-md-1">-</td>
                @endif
                <td>{{ $items->TANGGAL_TRANSAKSI_UANG }}</td>
                <td>{{ $items->JUMLAH_DEPOSIT_UANG }}</td>
                <td>{{ $items->BONUS_DEPOSIT_UANG }}</td>
                <td>{{ $items->SISA_DEPOSIT_UANG_TRANSAKSI}}</td>
                <td>{{ $items->TOTAL_DEPOSIT_UANG }}</td>
                <td>{{ $items->KEMBALIAN }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ url("dashboard/cetakStrukUang/".$items->ID_TRANSAKSI_UANG) }}" class="btn btn-info btn-sm">Cetak Kuitansi</a>
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