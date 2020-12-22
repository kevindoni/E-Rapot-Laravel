@extends('layouts.app')
@push('title', 'Jadwal')
@push('page')
  <li class="breadcrumb-item active">Jadwal</li>
@endpush
@push('styles')
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-jadwal">
            <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('jadwal-livewire')
        </div>
      </div>
    </div>
  </div>

  <!-- Add modal -->
  <div class="modal fade bd-example-modal-md tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Jadwal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('jadwal.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="kelas_id">Kelas</label>
                  <select id="kelas_id" name="kelas_id" class="select2bs4 form-control @error('kelas_id') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Kelas --</option>
                    @foreach ($kelas as $data)
                      <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="guru_id">Guru</label>
                  <select id="guru_id" name="guru_id" class="select2bs4 form-control @error('guru_id') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Guru --</option>
                    @foreach ($guru as $data)
                      <option value="{{ $data->id }}">{{ $data->nama_guru }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="mapel_id">Mata Pelajaran</label>
                  <select id="mapel_id" name="mapel_id" class="select2bs4 form-control @error('mapel_id') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Mata Pelajaran --</option>
                  </select>
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
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
    $("#SetData").addClass("active");
    $("#liSetData").addClass("menu-open");
    $("#SetJadwal").addClass("active");

    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })

    $(document).ready(function(){
      $('#kelas_id').change(function(){
        var kelas_id = $('#kelas_id option:selected').val();
        $.ajax({
          url: "{{ url('/jadwal/mapel') }}",
          type: "GET",
          data 	: {
            kelas : kelas_id,
          },
          dataType: "json",
          success: function(data){
            var mapel = "<option value='' selected disabled>-- Pilih Mata Pelajaran --</option>";
            $.each(data,function(index, val){
              mapel += `<option value="${val.id}">${val.nama_mapel}</option>`;
            });
            $("#mapel_id").html(mapel);
          },
          error: function(data){
            toastr.warning(data.statusText);
          }
        });
      });
    });
  </script>
@endpush
