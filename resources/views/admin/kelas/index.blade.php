@extends('layouts.app')
@push('title', 'Kelas')
@push('page')
  <li class="breadcrumb-item active">Kelas</li>
@endpush
@push('styles')
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-kelas">
            <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('kelas-livewire')
        </div>
      </div>
    </div>
  </div>

  <!-- Add modal -->
  <div class="modal fade bd-example-modal-md tambah-kelas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Kelas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('kelas.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="kelas">Kelas</label>
                  <select id="kelas" name="kelas" class="select2bs4 form-control @error('kelas') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Kelas --</option>
                    @foreach ($noKelas as $data)
                      <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="prodi_id">Jurusan</label>
                  <select id="prodi_id" name="prodi_id" class="select2bs4 form-control @error('prodi_id') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Jurusan --</option>
                    @foreach ($prodi as $data)
                      <option value="{{ $data->id }}">{{ $data->nama_prodi }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
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
