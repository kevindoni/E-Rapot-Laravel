@extends('layouts.app')
@push('title', 'Edit User')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">User</a></li>
  <li class="breadcrumb-item active"><a href="{{ route('user.show', $user->level) }}">{{ $user->level }}</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="card-body">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password">
            <small class="text-muted">Isi jika ingin ubah</small>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a href="{{ route('user.show', $user->level) }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('script')
  <script type="text/javascript">
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataUser").addClass("active");
  </script>
@endpush