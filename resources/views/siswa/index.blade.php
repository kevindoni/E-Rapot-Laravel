@extends('layouts.app')
@push('title', 'Nilai Rapot')
@section('content')
  <div class="row mt-4 justify-content-center">
    <div class="col-12">
      <div class="card shadow">
        @livewire('rapot')
      </div>
    </div>
  </div>
@endsection

