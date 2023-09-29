@extends('dashboard/layout')

@section ('title', 'Form Transaksi Deposit Uang')

@section('main')

    <form method="get" action="{{url('dashboard/inputDepositUang')}}"  enctype="multipart/form-data">
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
                        {{-- @else
                            <option value=""disabled>Semua member sudah teraktivasi</option> --}}
                        @endif
              </select>
            <div class="form-group">
                <label for="JUMLAH_DEPOSIT_UANG">Jumlah Deposit Uang</label>
                <input type="text" class="form-control" id="JUMLAH_DEPOSIT_UANG" name="JUMLAH_DEPOSIT_UANG" placeholder="Masukkan Jumlah Deposit Uang">
              </div>
              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ url('dashboard/transaksiDepositUang') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection