@extends('layouts.app')
@push('title', 'Catatan Akademik')
@push('page')
  <li class="breadcrumb-item active">Catatan Akademik</li>
@endpush
@section('content')
  <div class="col-md-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <tr>
                <td>Nama Kelas</td>
                <td>:</td>
                <td>{{ $kelas->nama_kelas }}</td>
              </tr>
              <tr>
                <td>Wali Kelas</td>
                <td>:</td>
                <td>
                  @if ($kelas->wali)
                    {{ $kelas->wali->nama_guru }}
                  @else
                    {{ " - " }}
                  @endif
                </td>
              </tr>
              <tr>
                <td>Jumlah Siswa</td>
                <td>:</td>
                <td>{{ $siswa->count() }}</td>
              </tr>
              <tr>
                <td>Semester</td>
                <td>:</td>
                <td>
                  @if ($tahun->semester == "Ganjil")
                    {{ $tahun->semester . " " . $tahun->tahun . "/" . ($tahun->tahun + 1) }}
                  @else
                    {{ $tahun->semester . " " . ($tahun->tahun - 1) . "/" . $tahun->tahun }}
                  @endif
                </td>
              </tr>
            </table>
            <hr>
          </div>
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  <th>Nama Siswa</th>
                  <th class="text-center">Catatan</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                @foreach ($siswa as $data)
                  @php
                    $array = array('siswa' => $data->siswa->id, 'tahun' => $tahun->id);
                    $jsonData = json_encode($array);
                  @endphp
                  @if ($data->cekCatatan($jsonData))
                    <input type="hidden" name="catatan_id" class="catatan_id_{{ $data->siswa->id }}" value="{{ $data->cekCatatan($jsonData)['id'] }}">
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $data->siswa->nama_siswa }}</td>
                      <td class="text-center">
                        <textarea  name="catatan" class="form-control catatan_{{ $data->siswa->id }}">{{ $data->cekCatatan($jsonData)['catatan'] }}</textarea>
                      </td>
                      <td class="ctr text-center">
                        <button type="button" class="btn btn-default btn_click load_{{ $data->siswa->id }}" data-id="{{ $data->siswa->id }}"><i class="nav-icon fas fa-save"></i></button>
                      </td>
                    </tr>
                  @else
                    <input type="hidden" name="catatan_id" class="catatan_id_{{ $data->siswa->id }}">
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $data->siswa->nama_siswa }}</td>
                      <td class="text-center">
                        <textarea  name="catatan" class="form-control catatan_{{ $data->siswa->id }}"></textarea>
                      </td>
                      <td class="ctr text-center">
                        <button type="button" class="btn btn-default btn_click load_{{ $data->siswa->id }}" data-id="{{ $data->siswa->id }}"><i class="nav-icon fas fa-save"></i></button>
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
@endsection
@push('script')
  <script>
    $("#Catatan").addClass("active");

    $(".btn_click").click(function(){
      var siswa_id = $(this).attr('data-id');
      var catatan_id = $(".catatan_id_" + siswa_id).val();
      var catatan = $(".catatan_" + siswa_id).val();
      var tahun_id = $("input[name=tahun_id]").val();
      $(".load_" + siswa_id).html(`<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="sr-only">Loading...</span></div>`);

      if (catatan == "") {
        toastr.error("Catatan tidak boleh ada yang kosong!");
        $(".load_" + siswa_id).html(`<i class="nav-icon fas fa-save"></i>`);
      } else {
        $.ajax({
          url: "{{ route('catatan.store') }}",
          type: "POST",
          dataType: 'json',
          data 	: {
            _token: '{{ csrf_token() }}',
            catatan_id : catatan_id,
            siswa_id : siswa_id,
            catatan : catatan,
            tahun_id : tahun_id,
          },
          success: function(data){
            if (data.success) {
              $(".catatan_id_" + siswa_id).val(data.data.id);
              toastr.success(data.success);
              $(".load_" + siswa_id).html(`<i class="nav-icon fas fa-save"></i>`);
            } else {
              toastr.error(data.error);
              $(".load_" + siswa_id).html(`<i class="nav-icon fas fa-save"></i>`);
            }
          },
          error: function (data) {
            toastr.warning(data.statusText);
            $(".load_" + siswa_id).html(`<i class="nav-icon fas fa-save"></i>`);
          }
        });
      }
    });
  </script>
@endpush