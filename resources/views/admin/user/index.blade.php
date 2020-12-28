@extends('layouts.app')
@push('title', 'User')
@push('page')
  <li class="breadcrumb-item active">User</li>
@endpush
@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Level User</th>
            <th>Jumlah User</th>
            <th>Lihat User</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($user as $role => $data)
            <tr>
              <td>{{ $role }}</td>
              <td>{{ $data->count() }}</td>
              <td>
                <a href="{{ route('user.show', $role) }}" class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Ditails</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@push('script')
  <script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataUser").addClass("active");
  </script>
@endpush