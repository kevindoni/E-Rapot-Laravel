@extends('layouts.app')
@push('title')
  User {{ $level }}
@endpush
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">User</a></li>
  <li class="breadcrumb-item active">{{ $level }}</li>
@endpush
@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <a href="{{ route('user.index') }}" class="btn btn-default btn-sm mr-1"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
          @if ($level == "Admin")
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-user">
              <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
            </button>
          @endif
        </h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              @if ($level != "Admin")
                <th>Username / Password Default</th>
              @else
                <th>Username</th>
              @endif
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-capitalize">{{ $data->name }}</td>
                @if ($level != "Admin" && $level == "Guru")
                  <td>
                    {{ $data->username . " / guru@123" }}
                  </td>
                @elseif ($level != "Admin" && $level == "Siswa")
                  <td>
                    {{ $data->username . " / siswa@123" }}
                  </td>
                @elseif ($level != "Admin" && $level == "Wali Kelas")
                  <td>
                    {{ $data->username . " / wali@" . $data->username }}
                  </td>
                @else
                  <td>
                    {{ $data->username }}
                  </td>
                @endif
                <td>
                  @if ($level != "Admin")
                    <a href="{{ route('user.reset', $data->id) }}" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-sync-alt"></i> &nbsp; Reset</a>
                  @else
                    <form action="{{ route('user.destroy', $data->id) }}" method="post">
                      @csrf
                      @method('delete')
                      <a href="{{ route('user.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                      <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                    </form>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Extra large modal -->
  <div class="modal fade bd-example-modal-md tambah-user" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah User Admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name">
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input id="username" type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" name="username">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password">
                </div>
                <div class="form-group">
                  <label for="password-confirm">Confirm Password</label>
                  <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
          </form>
        </div>
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