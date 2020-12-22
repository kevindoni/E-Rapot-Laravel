@extends('layouts.app')
@push('title', 'Edit Predikat')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('predikat.index') }}">Predikat</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Predikat</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('predikat.update', $predikat->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="predikat">Predikat</label>
                <input type="text" id="predikat" name="predikat" value="{{ $predikat->predikat }}" class="form-control @error('predikat') is-invalid @enderror" placeholder="Predikat" readonly>
              </div>
              <div class="form-group">
                <label for="normatif">Mapel Adaptif dan Normatif</label>
                <input type="text" id="normatif" name="normatif" maxlength="2" onkeypress="return inputAngka(event)" value="{{ $predikat->normatif }}" class="form-control @error('normatif') is-invalid @enderror" placeholder="Mapel Adaptif dan Normatif" required>
              </div>
              <div class="form-group">
                <label for="produktif">Mapel Produktif</label>
                <input type="text" id="produktif" name="produktif" maxlength="2" onkeypress="return inputAngka(event)" value="{{ $predikat->produktif }}" class="form-control @error('produktif') is-invalid @enderror" placeholder="Mapel Produktif" required>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('predikat.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('script')
  <script type="text/javascript">
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetPredikat").addClass("active");

    function inputAngka(event) {
      var charCode = (event.which) ? event.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }
      return true;
    }
  </script>
@endpush