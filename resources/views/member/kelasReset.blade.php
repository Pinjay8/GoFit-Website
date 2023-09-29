@extends('dashboard/layout')

@section ('title', 'Data Member')

@section('main')


  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{url("dashboard/resetKelasProcess")}}" class="btn btn-danger mt-2 ml-2 mb-3">Reset Kelas</a>
      <h6 class="m-0 font-weight-bold txt-title">Tampilan Semua Mereset Kelas</h6>
    </div>
        {{-- <div class="card">
          <div class="input-group">
            <form action="{{url('dashboard/searchMember')}}" method="get" class="d-flex">
                <input type="search" class="form-control" placeholder="Cari Nama Member" aria-label="Nama Member" aria-describedby="basic-addon2" name="keyword">
                <button class="btn buttonSubmit" type="submit">Cari</button>
            </form>
          </div>
        </div> --}}

    <div class="card-body'">
       {{-- <a href="{{url("dashboard/resetKelasProcess")}}" class="btn btn-danger mt-2 ml-2">Reset Kelas</a> --}}
      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Id Kelas</th>
              <th>ID Member</th>
              <th>Masa Berlaku</th>
              <th>Sisa Deposit</th>
              <th>Expired Kelas</th>
              {{-- <th>Tanggal Lahir Member</th>
              <th>Masa Aktivasi</th>
              <th>Sisa Deposit Uang</th>
              <th>Sisa Deposit Kelas</th>
              <th>Aksi</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($member as $users)
              <tr>
                <th>{{ $users->ID_MEMBER_DEPO }}</th>
                <td>{{ $users->ID_KELAS }}</td>
                <td>{{ $users->ID_MEMBER }}</td>
                <td>{{ $users->MASA_BERLAKU }}</td>
                <td>{{ $users->SISA_DEPO }}</td>
                <td>{{ $users->EXPIRED_KELAS }}</td>
                {{-- <td>{{ $users->TANGGAL_LAHIR_MEMBER }}</td>
                @if($users->MASA_AKTIVASI == null)
                  <td>Aktivasi belum dilakukan</td>
                @else
                <td>{{ $users->MASA_AKTIVASI }}</td>
                @endif
                @if($users->SISA_DEPOSIT_UANG == null)
                <td>0</td>
                @else
                <td>{{ $users->SISA_DEPOSIT_UANG }}</td>
                @endif
                @if($users->SISA_DEPOSIT_KELAS == null)
                <td>0</td>
                @else
                <td>{{ $users->SISA_DEPOSIT_KELAS }}</td>
                @endif
                <td>
                  <div class="d-flex">
                    <form action="{{url("dashboard/resetKelasProcess/".$users->ID_MEMBER)}}">
                      <button type="submit" class="btn btn-primary d-inline ml-1">Reset Kelas</button>
                    </form>
                  </div>
                </td> --}}
              </tr> 
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  

   <div class="card shadow mb-4">
    <div class="card-header py-3">

      <h6 class="m-0 font-weight-bold txt-title">Tampilan Setelah Data Mereset Kelas</h6>
    </div>
        {{-- <div class="card">
          <div class="input-group">
            <form action="{{url('dashboard/searchMember')}}" method="get" class="d-flex">
                <input type="search" class="form-control" placeholder="Cari Nama Member" aria-label="Nama Member" aria-describedby="basic-addon2" name="keyword">
                <button class="btn buttonSubmit" type="submit">Cari</button>
            </form>
          </div>
        </div> --}}

    <div class="card-body'">
       {{-- <a href="{{url("dashboard/resetKelasProcess")}}" class="btn btn-danger mt-2 ml-2">Reset Kelas</a> --}}
      <div class="table-responsive">
        <table class="table table-bordered mt-2 ml-2 mr-2" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Kelas</th>
              <th>ID Member</th>
              <th>Masa Berlaku</th>
              <th>Sisa Deposit</th>
              <th>Expired Kelas</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members_after as $users)
              <tr>
                <th>{{ $users->ID_MEMBER_DEPO }}</th>
                <td>{{ $users->ID_KELAS }}</td>
                <td>{{ $users->ID_MEMBER }}</td>
                <td>{{ $users->MASA_BERLAKU }}</td>
                <td>{{ $users->SISA_DEPO }}</td>
                <td>{{ $users->EXPIRED_KELAS }}</td>
                {{-- <td>{{ $users->TANGGAL_LAHIR_MEMBER }}</td>
                @if($users->MASA_AKTIVASI == null)
                  <td>Aktivasi belum dilakukan</td>
                @else
                <td>{{ $users->MASA_AKTIVASI }}</td>
                @endif
                @if($users->SISA_DEPOSIT_UANG == null)
                <td>0</td>
                @else
                <td>{{ $users->SISA_DEPOSIT_UANG }}</td>
                @endif
                @if($users->SISA_DEPOSIT_KELAS == null)
                <td>0</td>
                @else
                <td>{{ $users->SISA_DEPOSIT_KELAS }}</td>
                @endif
                <td>
                  <div class="d-flex">
                    <form action="{{url("dashboard/resetKelasProcess/".$users->ID_MEMBER)}}">
                      <button type="submit" class="btn btn-primary d-inline ml-1">Reset Kelas</button>
                    </form>
                  </div>
                </td> --}}
              </tr> 
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>


 


@endsection