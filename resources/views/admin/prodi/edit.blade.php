@extends('layouts.app')
@push('title', 'Edit Jurusan')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('prodi.index') }}">Jurusan</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Jurusan</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('prodi.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="prodi_id" value="{{ $prodi->id }}">
              <div class="form-group">
                <label for="nama_prodi">Nama Jurusan</label>
                <input type="text" id="nama_prodi" name="nama_prodi" value="{{ $prodi->nama_prodi }}" class="form-control @error('nama_prodi') is-invalid @enderror" placeholder="Nama Jurusan" required>
              </div>
              <div class="form-group">
                <label for="singkatan">Singkatan</label>
                <input type="text" id="singkatan" name="singkatan" value="{{ $prodi->singkatan }}" class="form-control @error('singkatan') is-invalid @enderror" placeholder="Singkatan" onkeyup="this.value = this.value.toUpperCase()" required>
              </div>
              <div class="form-group">
                <label for="bidang">Dasar Bidang Keahlian</label>
                <input type="text" id="bidang" name="bidang" value="{{ $prodi->bidang }}" class="form-control @error('bidang') is-invalid @enderror" placeholder="Dasar Bidang Keahlian" required>
              </div>
              <div class="form-group">
                <label for="program">Dasar Program Keahlian</label>
                <input type="text" id="program" name="program" value="{{ $prodi->program }}" class="form-control @error('program') is-invalid @enderror" placeholder="Dasar Program Keahlian" required>
              </div>
              <div class="form-group">
                <label for="kompetensi">Kompetensi Keahlian</label>
                <input type="text" id="kompetensi" name="kompetensi" value="{{ $prodi->kompetensi }}" class="form-control @error('kompetensi') is-invalid @enderror" placeholder="Kompetensi Keahlian" required>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('prodi.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('script')
  <script type="text/javascript">
    $("#DataMaster").addClass("active");
    $("#liDataMaster").addClass("menu-open");
    $("#DataProdi").addClass("active");
  </script>
@endpush