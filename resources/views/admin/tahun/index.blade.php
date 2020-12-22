@extends('layouts.app')
@push('title', 'Tahun')
@push('page')
  <li class="breadcrumb-item active">Tahun</li>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-tahun">
            <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('tahun-livewire')
        </div>
      </div>
    </div>
  </div>

  <!-- Add modal -->
  <div class="modal fade bd-example-modal-md tambah-tahun" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Tahun</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('tahun.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="semester">Semester</label>
                  <select id="semester" name="semester" class="select2bs4 form-control @error('semester') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Semester --</option>
                    @foreach ($semester as $data)
                      <option value="{{ $data }}">{{ $data }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tahun">Tahun</label>
                  <select id="tahun" name="tahun" class="select2bs4 form-control @error('tahun') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Tahun --</option>
                    @foreach ($year as $data)
                      <option value="{{ $data }}">{{ $data }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kpl_sklh">Kepala Sekolah</label>
                  <input type="text" id="kpl_sklh" name="kpl_sklh" class="form-control  @error('kpl_sklh') is-invalid @enderror" placeholder="Kepala Sekolah" required>
                </div>
                <div class="form-group">
                  <label for="nip_kespek">NIP Kepsek</label>
                  <input type="text" id="nip_kespek" name="nip_kespek" class="form-control  @error('nip_kespek') is-invalid @enderror" placeholder="NIP Kepsek" required>
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
