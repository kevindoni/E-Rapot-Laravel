@extends('layouts.app')
@push('title', 'Nilai Mapel')
@push('styles')
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
  <div class="row mt-4 justify-content-center">
    <div class="col-12">
      <div class="card shadow">
        <form action="{{ route('nilai-mapel.update', Auth::user()->data_id) }}" method="post">
          @csrf
          @method('patch')
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="kelas_id">Kelas</label>
                  <select id="kelas_id" name="kelas_id" class="select2bs4 form-control @error('kelas_id') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Kelas --</option>
                    @foreach ($kelas as $data)
                      <option value="{{ $data['id'] }}">{{ $data['nama_kelas'] }}</option>
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
          <!-- /.card-body -->
  
          <div class="card-footer">
            <button name="submit" class="btn btn-primary btn-block"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Input Nilai</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })

    $(document).ready(function(){
      $('#kelas_id').change(function(){
        var kelas_id = $('#kelas_id option:selected').val();
        $.ajax({
          url: "{{ url('/guru/jadwal') }}",
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
