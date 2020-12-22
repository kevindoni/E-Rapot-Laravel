@extends('layouts.app')
@push('title', 'Ekstra')
@push('page')
  <li class="breadcrumb-item active">Ekstra</li>
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-ekstra">
            <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('ekstra-livewire')
        </div>
      </div>
    </div>
  </div>

  <!-- Add modal -->
  <div class="modal fade bd-example-modal-md tambah-ekstra" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Ekstra</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('ekstra.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nama_ekstra">Nama Ekstra</label>
                  <input type="text" id="nama_ekstra" name="nama_ekstra" class="form-control @error('nama_ekstra') is-invalid @enderror" placeholder="Nama Jurusan" required>
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
    $("#DataEkstra").addClass("active");
  </script>
@endpush
