@extends('dashboard/layout')

@section ('title', 'Form Transaksi Deposit Kelas')


@section('main')
         <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Transaksi Deposit Kelas</h6>
    </div>

    <div class="card-body">
      <a href="{{ url('dashboard/createTransaksiKelas')}}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Generate Kelas </a>

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Member</th>
              <th>Nama Pegawai</th>
              <th>Nama Promo</th>
              <th>Kelas</th>
              <th>Jumlah Deposit</th>
              <th>Bonus Deposit</th>
              <th>Total Deposit</th>
              {{-- <th>Sisa Deposit Kelas</th> --}}
              <th>Jumlah Bayar</th>
              <th>Tanggal Deposit Kelas</th>
              <th>Masa Berlaku Kelas</th>
              <th>Kembalian</th>
              <th>Cetak</th> 
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksiKelas as $items)
              <tr>
                <th>{{ $items->ID_TRANSAKSI_KELAS }}</th>
                <td>{{ $items->member->NAMA_MEMBER }}</td>
                <td>{{ $items->pegawai->NAMA_PEGAWAI }}</td>
                @if ($items->ID_PROMO != null)
                      <td class="col-md-1">{{ $items->promo->JENIS_PROMO }}</td>
                @else 
                      <td class="col-md-1">-</td>
                @endif
                <td>{{ $items->kelas->NAMA_KELAS }}</td>
                <td>{{ $items->JUMLAH_DEPOSIT }}</td>
                @if ($items->BONUS_DEPOSIT_KELAS != null)
                      <td class="col-md-1">{{ $items->BONUS_DEPOSIT_KELAS }}</td>
                @else
                      <td class="col-md-1">0</td>
                @endif
                <td>{{ $items->TOTAL_DEPOSIT_KELAS }}</td>
                {{-- @if ($items->memberdepo->SISA_DEPO != null)
                <td>{{ $items->memberdepo->SISA_DEPO}}</td>
                @else
                      <td class="col-md-1">0</td>
                @endif --}}

                <td>{{ $items->JUMLAH_BAYAR }}</td>
                <td>{{ $items->TANGGAL_TRANSAKSI_KELAS }}</td>
                <td>{{ $items->MASA_BERLAKU_KELAS }}</td>
                <td>{{ $items->KEMBALIAN }}</td>

                <td>
                  <div class="d-flex">
                    <a href="{{ url("dashboard/cetakStrukKelas/".$items->ID_TRANSAKSI_KELAS) }}" class="btn btn-info btn-sm">Cetak Kuitansi</a>
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