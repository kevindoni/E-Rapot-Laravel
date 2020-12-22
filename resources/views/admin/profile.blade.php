@extends('layouts.app')
@push('title', 'Setting')
@push('page')
  <li class="breadcrumb-item active">Setting</li>
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Setting</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('simpan') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama_sekolah">Nama Sekolah</label>
                <input type="text" id="nama_sekolah" name="nama_sekolah" value="{{ $profile->nama_sekolah }}" class="form-control @error('nama_sekolah') is-invalid @enderror" placeholder="Nama Sekolah" required>
              </div>
              <div class="form-group">
                <label for="alamat_sekolah">Alamat Sekolah</label>
                <textarea id="alamat_sekolah" name="alamat_sekolah" class="form-control @error('alamat_sekolah') is-invalid @enderror" placeholder="Alamat Sekolah" required>{{ $profile->alamat_sekolah }}</textarea>
              </div>
              <div class="form-group">
                <label for="logo_sekolah">Logo Sekolah</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('logo_sekolah') is-invalid @enderror" name="logo_sekolah" id="logo_sekolah">
                  <label class="custom-file-label" for="logo_sekolah">Choose file</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('script')
  <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

  <script type="text/javascript">
    $("#SetProfile").addClass("active");

    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>
@endpush