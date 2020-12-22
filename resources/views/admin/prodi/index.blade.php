@extends('layouts.app')
@push('title', 'Jurusan')
@push('page')
  <li class="breadcrumb-item active">Jurusan</li>
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-prodi">
            <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('prodi-livewire')
        </div>
      </div>
    </div>
  </div>

  <!-- Add modal -->
  <div class="modal fade bd-example-modal-md tambah-prodi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Jurusan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('prodi.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nama_prodi">Nama Jurusan</label>
                  <input type="text" id="nama_prodi" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" placeholder="Nama Jurusan" required>
                </div>
                <div class="form-group">
                  <label for="singkatan">Singkatan</label>
                  <input type="text" id="singkatan" name="singkatan" class="form-control @error('singkatan') is-invalid @enderror" placeholder="Singkatan" onkeyup="this.value = this.value.toUpperCase()" required>
                </div>
                <div class="form-group">
                  <label for="bidang">Dasar Bidang Keahlian</label>
                  <input type="text" id="bidang" name="bidang" class="form-control @error('bidang') is-invalid @enderror" placeholder="Dasar Bidang Keahlian" required>
                </div>
                <div class="form-group">
                  <label for="program">Dasar Program Keahlian</label>
                  <input type="text" id="program" name="program" class="form-control @error('program') is-invalid @enderror" placeholder="Dasar Program Keahlian" required>
                </div>
                <div class="form-group">
                  <label for="kompetensi">Kompetensi Keahlian</label>
                  <input type="text" id="kompetensi" name="kompetensi" class="form-control @error('kompetensi') is-invalid @enderror" placeholder="Kompetensi Keahlian" required>
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
  <script>
    $("#DataMaster").addClass("active");
    $("#liDataMaster").addClass("menu-open");
    $("#DataProdi").addClass("active");
  </script>
@endpush
