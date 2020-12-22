@extends('layouts.app')
@push('title', 'Edit Kelas')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></li>
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
        <h3 class="card-title">Edit Kelas</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
              <div class="form-group">
                <label for="kelas">Kelas</label>
                <select id="kelas" name="kelas" class="select2bs4 form-control @error('kelas') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Kelas --</option>
                  @foreach ($noKelas as $data)
                    <option value="{{ $data['id'] }}"
                      @if ($kelas->kelas == $data['id'])
                        selected
                      @endif
                    >{{ $data['name'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="prodi_id">Jurusan</label>
                <select id="prodi_id" name="prodi_id" class="select2bs4 form-control @error('prodi_id') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Jurusan --</option>
                  @foreach ($prodi as $data)
                    <option value="{{ $data->id }}"
                      @if ($kelas->prodi_id == $data->id)
                        selected
                      @endif
                    >{{ $data->nama_prodi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="wali_kelas">Wali Kelas</label>
                <select id="wali_kelas" name="wali_kelas" class="select2bs4 form-control">
                  <option value=""
                    @if ($kelas->wali = false)
                      selected
                    @endif
                  >-- Pilih Wali Kelas --</option>
                  @foreach ($guru as $data)
                    @if ($data->cekWali($data->id) || $kelas->wali_kelas == $data->id)
                      <option value="{{ $data->id }}"
                        @if ($kelas->wali_kelas == $data->id)
                            selected
                        @endif
                      >{{ $data->nama_guru }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('kelas.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
    $("#DataMaster").addClass("active");
    $("#liDataMaster").addClass("menu-open");
    $("#DataKelas").addClass("active");

    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>
@endpush