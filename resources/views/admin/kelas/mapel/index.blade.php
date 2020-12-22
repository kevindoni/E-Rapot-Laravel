@extends('layouts.app')
@push('title', 'Kelas Mapel')
@push('page')
  <li class="breadcrumb-item active">Kelas Mapel</li>
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('kelas-mapel.create') }}" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-plus"></i> &nbsp; Tambah</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            @foreach ($kelas as $data)
              <div class="col-lg-4 col-md-6 mb-3">
                <div class="card">
                  <div class="card-header bg-info">
                    <h3 class="card-title">{{ $data->nama_kelas }}</h3>
                  </div>
                  <div class="card-body">
                    <table class="table" style="margin-top: -20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data->mapel as $mapel)
                          @php
                            $array = array('kelas' => $data->id, 'mapel' => $mapel->id);
                            $jsonData = json_encode($array);
                            $id = $data->kelasMapel($jsonData);
                          @endphp
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mapel->nama_mapel }}</td>
                            <td>
                              <form action="{{ route('kelas-mapel.destroy', $id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-times"></i></button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script>
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetKelasMapel").addClass("active");
  </script>
@endpush
