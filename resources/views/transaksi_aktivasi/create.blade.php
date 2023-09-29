@extends('dashboard/layout')

@section ('title', 'Form Transaksi Aktivasi Member Tahunan')

@section('main')

    <form method="get" action="{{ url('dashboard/indexAktivasi') }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold txt-title">Form Input Aktivasi Member</h6>
            </div>
            <div class="card-body">
            <p class="fw-bold">Member</p>
            <select class="form-control mb-3" aria-label="Default select example" name="ID_MEMBER">
                          <option value="" hidden>Memilih Member</option>
                          @if ($members->first() != null)
                              @foreach ($members as $item_member)
                                  <option value="{{ $item_member->ID_MEMBER }}">
                                      {{ $item_member->NAMA_MEMBER }}</option>
                              @endforeach
                          @else
                              <option value=""disabled>Semua member sudah teraktivasi</option>
                          @endif
                </select>
              </div> 
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Aktivasi</button>
              <a href="{{ url('dashboard/transaksiAktivasi') }}" class="btn btn-danger">Batal</a>
            </div>
          </div>
        </div>
      </div>
    </form>

@endsection