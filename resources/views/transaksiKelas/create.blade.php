@extends('dashboard/layout')

@section ('title', 'Form Transaksi Deposit Kelas')

@section('main')

    <form method="get" action="{{ url('dashboard/inputDepositKelas') }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold txt-title">Form Input Transasksi Uang</h6>
            </div>
            <div class="card-body">

           <label for="ID_MEMBER">Nama Member</label>
           <select class="form-control mb-3" aria-label="Default select example" name="ID_MEMBER">
                        <option value="" hidden>Memilih Member</option>
                        @if ($member->first() != null)
                            @foreach ($member as $item_member)
                                <option value="{{ $item_member->ID_MEMBER }}">
                                    {{ $item_member->NAMA_MEMBER }}</option>
                            @endforeach
                        @else
                            <option value=""disabled>Semua member sudah teraktivasi</option>
                        @endif
              </select>

            <label for="ID_KELAS">Nama Kelas</label>
                <select class="form-control mb-3" aria-label="Default select example" name="ID_KELAS">
                        <option value="" hidden>Memilih Kelas</option>
                        @if ($kelas->first() != null)
                            @foreach ($kelas as $item_kelas)
                                <option value="{{ $item_kelas->ID_KELAS}}">
                                    {{ $item_kelas->NAMA_KELAS }}</option>
                            @endforeach
                        @else
                            <option value=""disabled>Kelas Kosong</option>
                        @endif
                </select>

            <label>Nama Paket</label>
                <select class="form-control mb-3" aria-label="Default select example" name="JUMLAH_DEPOSIT" id="DEPOSIT">
                        <option value="" hidden>Memilih Packet</option>
                        <option value="5">5 Kelas</option>
                        <option value="10">10 Kelas</option>
                </select>   
             
              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ url('dashboard/transaksiDepositKelas') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection