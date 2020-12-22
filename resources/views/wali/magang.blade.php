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
                  <th style="width: 20%;">Nama Siswa</th>
                  <th class="text-center">Mitra DUDI</th>
                  <th class="text-center">Lokasi</th>
                  <th class="text-center">Lamanya</th>
                  <th class="text-center">Keterangan</th>
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
                  @if ($data->cekMagang($jsonData))
                    <input type="hidden" name="magang_id" class="magang_{{ $data->siswa->id }}" value="{{ $data->cekMagang($jsonData)['id'] }}">
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $data->siswa->nama_siswa }}</td>
                      <td class="text-center">
                        <input type="text" name="mitra" value="{{ $data->cekMagang($jsonData)['mitra'] }}" class="form-control mitra_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="text-center">
                        <input type="text" name="lokasi" value="{{ $data->cekMagang($jsonData)['lokasi'] }}" class="form-control lokasi_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="text-center">
                        <input type="text" name="lamanya" value="{{ $data->cekMagang($jsonData)['lamanya'] }}" class="form-control lamanya_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="text-center">
                        <input type="text" name="ket" value="{{ $data->cekMagang($jsonData)['ket'] }}" class="form-control ket_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="ctr text-center">
                        <button type="button" class="btn btn-default btn_click load_{{ $data->siswa->id }}" data-id="{{ $data->siswa->id }}"><i class="nav-icon fas fa-save"></i></button>
                      </td>
                    </tr>
                  @else
                    <input type="hidden" name="magang_id" class="magang_{{ $data->siswa->id }}">
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $data->siswa->nama_siswa }}</td>
                      <td class="text-center">
                        <input type="text" name="mitra" class="form-control mitra_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="text-center">
                        <input type="text" name="lokasi" class="form-control lokasi_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="text-center">
                        <input type="text" name="lamanya" class="form-control lamanya_{{ $data->siswa->id }}" autocomplete="off">
                      </td>
                      <td class="text-center">
                        <input type="text" name="ket" class="form-control ket_{{ $data->siswa->id }}" autocomplete="off">
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
      var magang_id = $(".magang_" + siswa_id).val();
      var mitra = $(".mitra_" + siswa_id).val();
      var lokasi = $(".lokasi_" + siswa_id).val();
      var lamanya = $(".lamanya_" + siswa_id).val();
      var ket = $(".ket_" + siswa_id).val();
      var tahun_id = $("input[name=tahun_id]").val();
      $(".load_" + siswa_id).html(`<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="sr-only">Loading...</span></div>`);

      if (mitra == "" || lokasi == "" || lamanya == "" || ket == "") {
        toastr.error("form tidak boleh ada yang kosong!");
        $(".load_" + siswa_id).html(`<i class="nav-icon fas fa-save"></i>`);
      } else {
        $.ajax({
          url: "{{ route('magang.store') }}",
          type: "POST",
          dataType: 'json',
          data 	: {
            _token: '{{ csrf_token() }}',
            magang_id : magang_id,
            siswa_id : siswa_id,
            mitra : mitra,
            lokasi : lokasi,
            lamanya : lamanya,
            ket : ket,
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