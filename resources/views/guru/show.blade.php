@extends('layouts.app')
@push('title', 'Input Nilai Mapel')
@section('content')
  <div class="row mt-4 justify-content-center">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card shadow">
        <div class="card-header">
          <h3 class="card-title">
            <a href="{{ route('nilai-mapel.index') }}" class="btn btn-default btn-sm"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
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
                  <td>Mata Pelajaran</td>
                  <td>:</td>
                  <td>
                    @if ($jadwal->mapel)
                      {{ $jadwal->mapel->nama_mapel }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
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
                    <th class="text-center" style="width: 50px;">No.</th>
                    <th>Nama Siswa</th>
                    <th class="text-center" style="width: 200px;">Pengetahuan</th>
                    <th class="text-center" style="width: 200px;">Keterampilan</th>
                    <th class="text-center" style="width: 50px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                  <input type="hidden" name="mapel_id" value="{{ $jadwal->mapel_id }}">
                  <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">
                  @foreach ($siswa as $data)
                    @php
                      $array = array('siswa' => $data->siswa->id, 'mapel' => $jadwal->mapel_id, 'tahun' => $tahun->id);
                      $jsonData = json_encode($array);
                    @endphp
                    @if ($data->cekNilaiMapel($jsonData))
                      <input type="hidden" name="nilai_mapel_id" class="nilai_mapel_{{ $data->siswa->id }}" value="{{ $data->cekNilaiMapel($jsonData)['id'] }}">
                      <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data->siswa->nama_siswa }}</td>
                        <td class="text-center">
                          <input type="text" name="nilai_p" maxlength="2" onkeypress="return inputAngka(event)" value="{{ $data->cekNilaiMapel($jsonData)['nilai_p'] }}" class="form-control text-center nilai_p_{{ $data->siswa->id }}" autocomplete="off">
                        </td>
                        <td class="text-center">
                          <input type="text" name="nilai_k" maxlength="2" onkeypress="return inputAngka(event)" value="{{ $data->cekNilaiMapel($jsonData)['nilai_k'] }}" class="form-control text-center nilai_k_{{ $data->siswa->id }}" autocomplete="off">
                        </td>
                        <td class="ctr text-center">
                          <button type="button" class="btn btn-default btn_click load_{{ $data->siswa->id }}" data-id="{{ $data->siswa->id }}"><i class="nav-icon fas fa-save"></i></button>
                        </td>
                      </tr>
                    @else
                      <input type="hidden" name="nilai_mapel_id" class="nilai_mapel_{{ $data->siswa->id }}">
                      <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data->siswa->nama_siswa }}</td>
                        <td class="text-center">
                          <input type="text" name="nilai_p" maxlength="2" onkeypress="return inputAngka(event)" class="form-control text-center nilai_p_{{ $data->siswa->id }}" autofocus autocomplete="off">
                        </td>
                        <td class="text-center">
                          <input type="text" name="nilai_k" maxlength="2" onkeypress="return inputAngka(event)" class="form-control text-center nilai_k_{{ $data->siswa->id }}" autocomplete="off">
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
  </div>
@endsection
@push('script')
  <script>
    function inputAngka(event) {
      var charCode = (event.which) ? event.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }
      return true;
    }

    $(".btn_click").click(function(){
      var siswa_id = $(this).attr('data-id');
      var nilai_mapel_id = $(".nilai_mapel_" + siswa_id).val();
      var kelas_id = $("input[name=kelas_id]").val();
      var mapel_id = $("input[name=mapel_id]").val();
      var nilai_p = $(".nilai_p_" + siswa_id).val();
      var nilai_k = $(".nilai_k_" + siswa_id).val();
      var tahun_id = $("input[name=tahun_id]").val();
      $(".load_" + siswa_id).html(`<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="sr-only">Loading...</span></div>`);

      if (nilai_p == "" || nilai_k == "") {
        toastr.error("Nilai tidak boleh ada yang kosong!");
        $(".load_" + siswa_id).html(`<i class="nav-icon fas fa-save"></i>`);
      } else {
        $.ajax({
          url: "{{ route('nilai-mapel.store') }}",
          type: "POST",
          dataType: 'json',
          data 	: {
            _token: '{{ csrf_token() }}',
            nilai_mapel_id : nilai_mapel_id,
            siswa_id : siswa_id,
            kelas_id : kelas_id,
            mapel_id : mapel_id,
            nilai_p : nilai_p,
            nilai_k : nilai_k,
            tahun_id : tahun_id,
          },
          success: function(data){
            if (data.success) {
              $(".nilai_mapel_" + siswa_id).val(data.data.id);
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
