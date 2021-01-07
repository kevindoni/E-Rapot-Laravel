@extends('layouts.app')
@push('title', 'Tambah Lulus')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('lulus.index') }}">Lulus</a></li>
  <li class="breadcrumb-item active">Tambah</li>
@endpush
@push('styles')
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush
@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Lulus</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('lulus.store') }}" method="post">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="tgl_lulus">Tanggal Lulus</label>
                  <input type="date" id="tgl_lulus" name="tgl_lulus" class="form-control  @error('tgl_lulus') is-invalid @enderror" required>
                </div>
                <div class="form-group">
                  <label for="siswa">Lulus</label>
                  <select class="duallistbox" name="siswa[]" id="siswa" multiple="multiple">
                    @foreach ($siswa as $data)
                      <option value="{{ $data->id }}">{{ $data->nama_siswa }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="{{ route('lulus.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
@push('script')
  <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

  <script>
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetLulus").addClass("active");

    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })

    $('.duallistbox').bootstrapDualListbox()
  </script>
@endpush
