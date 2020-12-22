@extends('layouts.app')
@push('title', 'Lulus')
@push('page')
  <li class="breadcrumb-item active">Lulus</li>
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('lulus.create') }}" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-plus"></i> &nbsp; Tambah</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('lulus-livewire')
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script>
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetLulus").addClass("active");
  </script>
@endpush
