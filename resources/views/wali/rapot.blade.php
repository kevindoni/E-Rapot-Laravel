@extends('layouts.app')
@push('title', 'Nilai Rapot Siswa')
@push('page')
  <li class="breadcrumb-item active">Nilai Rapot Siswa</li>
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        @livewire('wali-rapot')
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script>
    $("#WaliRapot").addClass("active");
  </script>
@endpush
