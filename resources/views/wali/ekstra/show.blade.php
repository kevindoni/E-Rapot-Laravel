@extends('layouts.app')
@push('title', 'Nilai Ekstra')
@push('page')
  <li class="breadcrumb-item active">Nilai Ekstra</li>
@endpush
@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <a href="{{ route('nilai-ekstra.index') }}" class="btn btn-default btn-sm"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table" style="margin-top: -10px;">
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
              <tr>
                <td>Ekstra Kurikuler</td>
                <td>:</td>
                <td>{{ $ekstra->nama_ekstra }}</td>
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
                  <th class="text-center">Nilai</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <input type="hidden" name="ekstra_id" value="{{ $ekstra->id }}">
                <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                @foreach ($siswa as $data)
                  @php
                    $array = array('siswa' => $data->siswa->id, 'ekstra' => $ekstra->id, 'tahun' => $tahun->id);
                    $jsonData = json_encode($array);
                  @endphp
                  @if ($data->cekNilaiEkstra($jsonData))
                    <input type="hidden" name="nilai_ekstra_id" class="nilai_ekstra_{{ $data->siswa->id }}" value="{{ $data->cekNilaiEkstra($jsonData)['id'] }}">
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $data->siswa->nama_siswa }}</td>
                      <td class="text-center">
                        <input type="text" name="nilai" value="{{ $data->cekNilaiEkstra($jsonData)['nilai'] }}" class="form-control text-center nilai_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="ctr text-center">
                        <button type="button" class="btn btn-default btn_click load_{{ $data->siswa->id }}" data-id="{{ $data->siswa->id }}"><i class="nav-icon fas fa-save"></i></button>
                      </td>
                    </tr>
                  @else
                    <input type="hidden" name="nilai_ekstra_id" class="nilai_ekstra_{{ $data->siswa->id }}">
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $data->siswa->nama_siswa }}</td>
                      <td class="text-center">
                        <input type="text" name="nilai" class="form-control text-center nilai_{{ $data->siswa->id }}" autocomplete="off">
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
    $("#NilaiEkstra").addClass("active");

    $(".btn_click").click(function(){
      var siswa_id = $(this).attr('data-id');
      var nilai_ekstra_id = $(".nilai_ekstra_" + siswa_id).val();
      var ekstra_id = $("input[name=ekstra_id]").val();
      var nilai = $(".nilai_" + siswa_id).val();
      var tahun_id = $("input[name=tahun_id]").val();
      $(".load_" + siswa_id).html(`<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="sr-only">Loading...</span></div>`);

      if (nilai == "") {
        toastr.error("Nilai tidak boleh ada yang kosong!");
        $(".load_" + siswa_id).html(`<i class="nav-icon fas fa-save"></i>`);
      } else {
        $.ajax({
          url: "{{ route('nilai-ekstra.store') }}",
          type: "POST",
          dataType: 'json',
          data 	: {
            _token: '{{ csrf_token() }}',
            nilai_ekstra_id : nilai_ekstra_id,
            siswa_id : siswa_id,
            ekstra_id : ekstra_id,
            nilai : nilai,
            tahun_id : tahun_id,
          },
          success: function(data){
            if (data.success) {
              $(".nilai_ekstra_" + siswa_id).val(data.data.id);
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