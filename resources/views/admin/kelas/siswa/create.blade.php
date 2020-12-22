@extends('layouts.app')
@push('title', 'Tambah Kelas Siswa')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('kelas-siswa.index') }}">Kelas Siswa</a></li>
  <li class="breadcrumb-item active">Tambah</li>
@endpush
@push('styles')
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush
@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Kelas Siswa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('kelas-siswa.store') }}" method="post">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="kelas">Kelas</label>
                  <select id="kelas" name="kelas" class="select2bs4 form-control">
                    <option value="" selected disabled>-- Pilih Kelas --</option>
                    @foreach ($kelas as $data)
                      <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="siswa">Siswa</label>
                  <select class="duallistbox" name="siswa[]" id="siswa" multiple="multiple">
                    @foreach ($siswa as $data)
                      @if ($data->cekSiswa($data->id))
                        <option value="{{ $data->id }}">{{ $data->nama_siswa }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="{{ route('kelas-siswa.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
@push('script')
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

  <script>
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetKelasSiswa").addClass("active");

    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })

    $('.duallistbox').bootstrapDualListbox()
  </script>
@endpush
