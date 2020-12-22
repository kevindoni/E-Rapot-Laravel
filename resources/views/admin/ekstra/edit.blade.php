@extends('layouts.app')
@push('title', 'Edit Ekstra')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('ekstra.index') }}">Ekstra</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Ekstra</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('ekstra.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="ekstra_id" value="{{ $ekstra->id }}">
              <div class="form-group">
                <label for="nama_ekstra">Nama Ekstra</label>
                <input type="text" id="nama_ekstra" name="nama_ekstra" value="{{ $ekstra->nama_ekstra }}" class="form-control @error('nama_ekstra') is-invalid @enderror" placeholder="Nama Ekstra" required>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('ekstra.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
    $("#DataEkstra").addClass("active");
  </script>
@endpush