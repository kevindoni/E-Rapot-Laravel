@extends('layouts.app')
@push('title', 'Mapel')
@push('page')
  <li class="breadcrumb-item active">Mapel</li>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-mapel">
            <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('mapel-livewire')
        </div>
      </div>
    </div>
  </div>

  <!-- Add modal -->
  <div class="modal fade bd-example-modal-md tambah-mapel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Mapel</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('mapel.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nama_mapel">Nama Mapel</label>
                  <input type="text" id="nama_mapel" name="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror" placeholder="Nama Mata Pelajaran" required>
                </div>
                <div class="form-group">
                  <label for="kelompok">Kelompok</label>
                  <select id="kelompok" name="kelompok" class="select2bs4 form-control @error('kelompok') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Kelompok Mapel --</option>
                    @foreach ($kelompok as $data)
                      <option value="{{ $data }}">{{ $data }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kkm">Nilai KKM</label>
                  <input type="text" id="kkm" name="kkm" onkeypress="return inputAngka(event)" maxlength="2" class="form-control @error('kkm') is-invalid @enderror" placeholder="Nilai KKM" required>
                </div>
                <div class="form-group">
                  <label for="bobot_p">Bobot Pengetahuan</label>
                  <input type="text" id="bobot_p" name="bobot_p" onkeypress="return inputAngka(event)" maxlength="2" class="form-control @error('bobot_p') is-invalid @enderror" placeholder="Bobot Pengetahuan" required>
                </div>
                <div class="form-group">
                  <label for="bobot_k">Bobot Keterampilan</label>
                  <input type="text" id="bobot_k" name="bobot_k" onkeypress="return inputAngka(event)" maxlength="2" class="form-control @error('bobot_k') is-invalid @enderror" placeholder="Bobot Keterampilan" required>
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
    $("#DataMapel").addClass("active");

    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })

    function inputAngka(event) {
      var charCode = (event.which) ? event.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }
      return true;
    }
  </script>
@endpush
