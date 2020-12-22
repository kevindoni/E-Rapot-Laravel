@extends('layouts.app')
@push('title', 'Predikat')
@push('page')
  <li class="breadcrumb-item active">Predikat</li>
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-striped" style="margin: 6px 0">
            <thead>
              <tr>
                <th>No</th>
                <th>Predikat</th>
                <th>Mapel Adaptif dan Normatif</th>
                <th>Mapel Produktif</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($predikat->count() > 0)
                @foreach ($predikat as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->predikat }}</td>
                    <td>{{ $data->normatif }}</td>
                    <td>{{ $data->produktif }}</td>
                    <td>
                      <a href="{{ route('predikat.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="5" class="text-center">Data Predikat Tidak Ada!</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script>
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetPredikat").addClass("active");
  </script>
@endpush
