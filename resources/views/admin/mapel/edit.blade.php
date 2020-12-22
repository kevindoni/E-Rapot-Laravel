@extends('layouts.app')
@push('title', 'Edit Mapel')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('mapel.index') }}">Mapel</a></li>
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
        <h3 class="card-title">Edit Mapel</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('mapel.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
              <div class="form-group">
                <label for="nama_mapel">Nama Mapel</label>
                <input type="text" id="nama_mapel" name="nama_mapel" value="{{ $mapel->nama_mapel }}" class="form-control @error('nama_mapel') is-invalid @enderror" placeholder="Nama Mata Pelajaran" required>
              </div>
              <div class="form-group">
                <label for="kelompok">Kelompok</label>
                <select id="kelompok" name="kelompok" class="form-control @error('kelompok') is-invalid @enderror select2bs4" required>
                  <option value="">-- Pilih Kelompok Mapel --</option>
                  @foreach ($kelompok as $data)
                    <option value="{{ $data }}"
                      @if ($mapel->kelompok == $data)
                          selected
                      @endif
                    >{{ $data }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="kkm">Nilai KKM</label>
                <input type="text" id="kkm" name="kkm" value="{{ $mapel->kkm }}" onkeypress="return inputAngka(event)" maxlength="2" class="form-control @error('kkm') is-invalid @enderror" placeholder="Nilai KKM" required>
              </div>
              <div class="form-group">
                <label for="bobot_p">Bobot Pengetahuan</label>
                <input type="text" id="bobot_p" name="bobot_p" value="{{ $mapel->bobot_p }}" onkeypress="return inputAngka(event)" maxlength="2" class="form-control @error('bobot_p') is-invalid @enderror" placeholder="Bobot Pengetahuan" required>
              </div>
              <div class="form-group">
                <label for="bobot_k">Bobot Keterampilan</label>
                <input type="text" id="bobot_k" name="bobot_k" value="{{ $mapel->bobot_k }}" onkeypress="return inputAngka(event)" maxlength="2" class="form-control @error('bobot_k') is-invalid @enderror" placeholder="Bobot Keterampilan" required>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('mapel.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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