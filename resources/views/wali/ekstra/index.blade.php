@extends('layouts.app')
@push('title', 'Nilai Ekstra')
@push('page')
  <li class="breadcrumb-item active">Nilai Ekstra</li>
@endpush
@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Ekstrakurikuler</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ekstra as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_ekstra }}</td>
                <td>
                  <a href="{{ route('nilai-ekstra.show', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-pen"></i> &nbsp; Input Nilai</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
@endsection
@push('script')
  <script>
    $("#NilaiEkstra").addClass("active");
  </script>
@endpush