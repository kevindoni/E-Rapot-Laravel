@extends('layouts.app')
@push('title', 'Edit Tahun')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('tahun.index') }}">Tahun</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endpush
@push('styles')
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Tahun</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('tahun.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
              <div class="form-group">
                <label for="semester">Semester</label>
                <select id="semester" name="semester" class="select2bs4 form-control @error('semester') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Semester --</option>
                  @foreach ($semester as $data)
                    <option value="{{ $data }}"
                      @if ($tahun->semester == $data)
                        selected
                      @endif
                    >{{ $data }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" name="tahun" class="select2bs4 form-control @error('tahun') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Tahun --</option>
                  @foreach ($year as $data)
                    <option value="{{ $data }}"
                      @if ($tahun->tahun == $data)
                        selected
                      @endif
                    >{{ $data }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="kpl_sklh">Kepala Sekolah</label>
                <input type="text" id="kpl_sklh" name="kpl_sklh" value="{{ $tahun->kpl_sklh }}" class="form-control  @error('kpl_sklh') is-invalid @enderror" placeholder="Kepala Sekolah" required>
              </div>
              <div class="form-group">
                <label for="nip_kespek">NIP Kepsek</label>
                <input type="text" id="nip_kespek" name="nip_kespek" value="{{ $tahun->nip_kespek }}" class="form-control  @error('nip_kespek') is-invalid @enderror" placeholder="NIP Kepsek" required>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('tahun.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('script')
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script type="text/javascript">
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetTahun").addClass("active");

    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>
@endpush