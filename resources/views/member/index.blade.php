@extends('dashboard/layout')

@section ('title', 'Data Member')

@section('main')
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Data Member</h6>
    </div>
           {{-- @if($errors->any())
            <div class="alert alert-primary" role="alert alert">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
            </div>
          @endif --}}

        <div class="card">
          <div class="input-group">
            <form action="{{url('dashboard/searchMember')}}" method="get" class="d-flex">
                <input type="search" class="form-control" placeholder="Cari Nama Member" aria-label="Nama Member" aria-describedby="basic-addon2" name="keyword">
                <button class="btn buttonSubmit" type="submit">Cari</button>
            </form>
          </div>
        </div>

          @If(Session::get('success'))
            <div class="alert alert-success mt-5" role="alert">
                {{Session('success')}}
            </div>
          @endif

          @If(Session::get('error'))
            <div class="alert alert-warning" role="alert">
                {{Session('error')}}
            </div>
          @endif 

    <div class="card-body'">
      <a href="{{ url('dashboard/createMember')}}" class="btn mb-3 mt-3 ml-2 buttonSubmit">Tambah Member</a>

      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Member</th>
              <th>Nomor Telepon Member</th>
              <th>Usia</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir Member</th>
              <th>Masa Aktivasi</th>
              <th>Sisa Deposit Uang</th>
              {{-- <th>Sisa Deposit Kelas</th> --}}
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as $users)
              <tr>
                <th>{{ $users->ID_MEMBER }}</th>
                <td>{{ $users->NAMA_MEMBER }}</td>
                <td>{{ $users->NO_TELPON_MEMBER }}</td>
                <td>{{ $users->USIA_MEMBER }}</td>
                <td>{{ $users->ALAMAT_MEMBER }}</td>
                <td>{{ $users->JENIS_KELAMIN_MEMBER }}</td>
                <td>{{ $users->TANGGAL_LAHIR_MEMBER }}</td>
                @if($users->MASA_AKTIVASI == null)
                  <td>Aktivasi belum dilakukan</td>
                @else
                <td>{{ $users->MASA_AKTIVASI }}</td>
                @endif
                @if($users->SISA_DEPOSIT_UANG === null)
                <td>0</td>
                @else
                <td>{{ $users->SISA_DEPOSIT_UANG }}</td>
                @endif
                {{-- @if($users->SISA_DEPOSIT_KELAS === null)
                <td>0</td>
                @else
                <td>{{ $users->SISA_DEPOSIT_KELAS }}</td>
                @endif --}}
                <td>
                  <div class="d-flex">
                    <a href="{{ url("dashboard/editMember/".$users->ID_MEMBER)}}" class="btn btn-warning mr-1">Edit</a>
                    <form action="{{ url("dashboard/destroy_member/".$users->ID_MEMBER) }}" method="POST">
                    @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger d-inline">Hapus</button>
                    </form>
                    @csrf
                      <form action="{{ url("dashboard/resetPassword/".$users->ID_MEMBER) }}">
                      <button type="submit" class="btn btn-primary d-inline ml-1">Reset Passsword</button>
                    </form>
                    <a href="{{ url("dashboard/cetakMember/".$users->ID_MEMBER) }}" class="btn btn-info ml-1">Cetak Member</a>
                  </div>
                  {{-- <a href="{{ url("dashboard/destroy_member/".$users->ID_MEMBER)}}" class="btn btn-danger">Hapus</a> --}}
                </td>
              </tr> 
              @endforeach
            </tbody>
        </table>
        {{ $members->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>

@endsection