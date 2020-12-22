@extends('layouts.app')
@push('title', 'Nilai Rapot Siswa')
@push('page')
  <li class="breadcrumb-item active">Nilai Rapot Siswa</li>
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        @livewire('admin-rapot', ['id' => $id])
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script>
    $("#AdminRapot").addClass("active");
  </script>
@endpush
