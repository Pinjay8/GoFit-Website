@extends('dashboard/layout')

@section ('title', 'Data Instruktur')

@section('main')
  
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold txt-title">Tampilan Reset Izin Instruktur</h5>
    </div>
        <div class="card">
          {{-- <div class="input-group">
            <form action="{{url('dashboard/searchInstruktur')}}" method="get" class="d-flex">
                <input type="search" class="form-control" placeholder="Cari Nama Instruktur" aria-label="Nama Instruktur" aria-describedby="basic-addon2" name="keyword">
                <button class="btn buttonSubmit" type="submit">Cari</button>
            </form>
          </div>
        </div> --}}

    <div class="card-body'">
      <a href="{{ url('dashboard/resetIzinProcess')}}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Reset Instruktur</a>
      @if(session()->has('success'))
          <div class="alert alert-success" role="alert">
              {{session()->get('message')}}
          </div>
      @endif

          {{-- <div class="alert alert-success" role="alert">
              {{Session::get('success')}}
          </div> --}}

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
              <th>ID</th>
              <th>Nama Instruktur</th>
              <th>Usia</th>
              <th>Jenis Kelamin</th>
              <th>Nomor Telepon Instruktur</th>
              <th>Jumlah Terlambat</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($instrukturs as $users)
              <tr>
                <th>{{ $users->ID_INSTRUKTUR }}</th>
                <td>{{ $users->NAMA_INSTRUKTUR }}</td>
                <td>{{ $users->USIA_INSTRUKTUR }}</td>
                <td>{{ $users->JENIS_KELAMIN_INSTRUKTUR }}</td>
                <td>{{ $users->NO_TELPON_INSTRUKTUR}}</td>
                @if ($users->JUMLAH_TERLAMBAT != null || $users->JUMLAH_TERLAMBAT != 0)
                            <td class="col-md-5">{{ $users->JUMLAH_TERLAMBAT }}</td>
                        @else
                            <td class="col-md-5">0</td>
                        @endif
               {{-- <td>
                <div class="d-flex">
                    <a href="{{ url("dashboard/editInstruktur/".$users->ID_INSTRUKTUR)}}" class="btn btn-warning mr-1">Edit</a>
                    <form action="{{ url("dashboard/destroyInstruktur/".$users->ID_INSTRUKTUR) }}" method="POST">
                    @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger d-inline">Hapus</button>
                    </form>
                  </div>
               </td> --}}

              </tr> 
              @endforeach
            </tbody>
        </table>
        {{-- {{ $instrukturs->links('pagination::bootstrap-5') }} --}}
      </div>
    </div>
  </div>

@endsection