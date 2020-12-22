@extends('layouts.app')
@push('title', 'Edit Jadwal')
@push('page')
  <li class="breadcrumb-item active"><a href="{{ route('jadwal.index') }}">Jadwal</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endpush
@push('styles')
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Jadwal</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('jadwal.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
              <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select id="kelas_id" name="kelas_id" class="select2bs4 form-control @error('kelas_id') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Kelas --</option>
                  @foreach ($kelas as $data)
                    <option value="{{ $data->id }}"
                      @if ($data->id == $jadwal->kelas_id)
                        selected
                      @endif
                    >{{ $data->nama_kelas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="guru_id">Guru</label>
                <select id="guru_id" name="guru_id" class="select2bs4 form-control @error('guru_id') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Guru --</option>
                  @foreach ($guru as $data)
                    <option value="{{ $data->id }}"
                      @if ($data->id == $jadwal->guru_id)
                        selected
                      @endif
                    >{{ $data->nama_guru }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="mapel_id">Mata Pelajaran</label>
                <select id="mapel_id" name="mapel_id" class="select2bs4 form-control @error('mapel_id') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Mata Pelajaran --</option>
                  @foreach ($mapel as $data)
                    <option value="{{ $data->mapel->id }}"
                      @if ($data->mapel->id == $jadwal->mapel_id)
                        selected
                      @endif
                    >{{ $data->mapel->nama_mapel }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="{{ route('jadwal.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('script')
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script type="text/javascript">
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