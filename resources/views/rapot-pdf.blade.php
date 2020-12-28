<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E - Rapot</title>
    <link rel="shrotcut icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> --}}
    <style>
      thead > tr > th, tbody > tr > td{
        vertical-align: middle !important;
      }

      .callout {
        border-radius: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        box-shadow: none;
        margin-bottom: 1rem;
        padding: 1rem;
      }
    </style>
  </head>
  <body>
    <div class="row" style="margin-top: -10px;">
      <div class="col-12">
        <table class="table" style="margin-top: -10px;">
          <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td>{{ $siswa->nama_siswa }}</td>
          </tr>
          <tr>
            <td>NIS / NISN</td>
            <td>:</td>
            <td>{{ $siswa->no_induk . ' / ' . $siswa->nisn }}</td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>
              @if ($kelas->kelas)
                {{ $kelas->kelas->nama_kelas }}
              @else
                {{ " - " }}
              @endif
            </td>
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
            <td>Semester</td>
            <td>:</td>
            <td>{{ $tahun->semester }}</td>
          </tr>
          <tr>
            <td>Tahun Pelajaran</td>
            <td>:</td>
            <td>
              @if ($tahun->semester == "Ganjil")
                {{ $tahun->tahun . "/" . ($tahun->tahun + 1) }}
              @else
                {{ ($tahun->tahun - 1) . "/" . $tahun->tahun }}
              @endif
            </td>
          </tr>
        </table>
        <hr>
        <h4 class="mb-3">A. Nilai Akademik</h4>
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Mata Pelajaran</th>
              <th class="text-center">Pengetahuan</th>
              <th class="text-center">Keterampilan</th>
              <th class="text-center">Nilai Akhir</th>
              <th class="text-center">Predikat</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th colspan="6">A. Muatan Nasional</th>
            </tr>
            @if ($mapel && $mapel['Muatan Nasional'] && count($mapel['Muatan Nasional']) > 0)
              @foreach ($mapel['Muatan Nasional'] as $data)
                @php
                  $array = array('siswa' => $siswa->id, 'mapel' => $data->mapel_id, 'tahun' => $tahun->id);
                  $jsonData = json_encode($array);
                @endphp
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $data->mapel->nama_mapel }}</td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_p'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_k'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100) }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      @php
                        $nilai = round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100);
                        $arrayPredikat = array('nilai' => $nilai, 'kelompok' => $data->kelompok);
                        $jsonPredikat = json_encode($arrayPredikat);
                      @endphp
                      {{ $data->cekPredikat($jsonPredikat)['predikat'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-center">1</td>
                <td> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
              </tr>
            @endif
            <tr>
              <th colspan="6">B. Muatan Kewilayahan</th>
            </tr>
            @if ($mapel && $mapel['Muatan Kewilayahan'] && count($mapel['Muatan Kewilayahan']) > 0)
              @foreach ($mapel['Muatan Kewilayahan'] as $data)
                @php
                  $array = array('siswa' => $siswa->id, 'mapel' => $data->mapel_id, 'tahun' => $tahun->id);
                  $jsonData = json_encode($array);
                @endphp
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $data->mapel->nama_mapel }}</td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_p'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_k'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100) }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      @php
                        $nilai = round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100);
                        $arrayPredikat = array('nilai' => $nilai, 'kelompok' => $data->kelompok);
                        $jsonPredikat = json_encode($arrayPredikat);
                      @endphp
                      {{ $data->cekPredikat($jsonPredikat)['predikat'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-center">1</td>
                <td> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
              </tr>
            @endif
            <tr>
              <th colspan="6">C. Muatan Peminatan Kejurusan</th>
            </tr>
            <tr>
              <th class="text-center">C1</th>
              <th colspan="5">
                Dasar Bidang Keahlian : 
                @if ($kelas->kelas && $kelas->kelas->prodi)
                  {{ $kelas->kelas->prodi->bidang }}
                @else
                  {{ " - " }}
                @endif
              </th>
            </tr>
            @if ($mapel && $mapel['Dasar Bidang Keahlian'] && count($mapel['Dasar Bidang Keahlian']) > 0)
              @foreach ($mapel['Dasar Bidang Keahlian'] as $data)
                @php
                  $array = array('siswa' => $siswa->id, 'mapel' => $data->mapel_id, 'tahun' => $tahun->id);
                  $jsonData = json_encode($array);
                @endphp
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $data->mapel->nama_mapel }}</td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_p'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_k'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100) }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      @php
                        $nilai = round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100);
                        $arrayPredikat = array('nilai' => $nilai, 'kelompok' => $data->kelompok);
                        $jsonPredikat = json_encode($arrayPredikat);
                      @endphp
                      {{ $data->cekPredikat($jsonPredikat)['predikat'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-center">1</td>
                <td> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
              </tr>
            @endif
            <tr>
              <th class="text-center">C2</th>
              <th colspan="5">
                Dasar Program Keahlian : 
                @if ($kelas->kelas && $kelas->kelas->prodi)
                  {{ $kelas->kelas->prodi->program }}
                @else
                  {{ " - " }}
                @endif
              </th>
            </tr>
            @if ($mapel && $mapel['Dasar Program Keahlian'] && count($mapel['Dasar Program Keahlian']) > 0)
              @foreach ($mapel['Dasar Program Keahlian'] as $data)
                @php
                  $array = array('siswa' => $siswa->id, 'mapel' => $data->mapel_id, 'tahun' => $tahun->id);
                  $jsonData = json_encode($array);
                @endphp
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $data->mapel->nama_mapel }}</td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_p'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_k'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100) }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      @php
                        $nilai = round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100);
                        $arrayPredikat = array('nilai' => $nilai, 'kelompok' => $data->kelompok);
                        $jsonPredikat = json_encode($arrayPredikat);
                      @endphp
                      {{ $data->cekPredikat($jsonPredikat)['predikat'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-center">1</td>
                <td> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
              </tr>
            @endif
            <tr>
              <th class="text-center">C3</th>
              <th colspan="5">
                Kompetensi Keahlian : 
                @if ($kelas->kelas && $kelas->kelas->prodi)
                  {{ $kelas->kelas->prodi->kompetensi }}
                @else
                  {{ " - " }}
                @endif
              </th>
            </tr>
            @if ($mapel && $mapel['Kompetensi Keahlian'] && count($mapel['Kompetensi Keahlian']) > 0)
              @foreach ($mapel['Kompetensi Keahlian'] as $data)
                @php
                  $array = array('siswa' => $siswa->id, 'mapel' => $data->mapel_id, 'tahun' => $tahun->id);
                  $jsonData = json_encode($array);
                @endphp
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $data->mapel->nama_mapel }}</td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_p'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ $data->cekNilaiMapel($jsonData)['nilai_k'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      {{ round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100) }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($data->cekNilaiMapel($jsonData))
                      @php
                        $nilai = round(($data->cekNilaiMapel($jsonData)['nilai_p'] * $data->mapel->bobot_p + $data->cekNilaiMapel($jsonData)['nilai_k'] * $data->mapel->bobot_k) / 100);
                        $arrayPredikat = array('nilai' => $nilai, 'kelompok' => $data->kelompok);
                        $jsonPredikat = json_encode($arrayPredikat);
                      @endphp
                      {{ $data->cekPredikat($jsonPredikat)['predikat'] }}
                    @else
                      {{ " - " }}
                    @endif
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-center">1</td>
                <td> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
              </tr>
            @endif
          </tbody>
        </table>
        <h4 class="mb-3">B. Catatan Akademik</h4>
        <div class="callout">
          <p>
            @if ($catatan)
              {{ $catatan->catatan }}
            @else
              {{ " - " }}
            @endif
          </p>
        </div>
        <h4 class="mb-3">C. Praktik Kerja Lapangan</h4>
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Mitra DUDI</th>
              <th class="text-center">Lokasi</th>
              <th class="text-center">Lamanya</th>
              <th class="text-center">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            @if ($magang->count() > 0)
              @foreach ($magang as $data)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $data->mitra }}</td>
                  <td class="text-center">{{ $data->lokasi }}</td>
                  <td class="text-center">{{ $data->lamanya }}</td>
                  <td class="text-center">{{ $data->ket }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-center">1</td>
                <td> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
              </tr>
            @endif
          </tbody>
        </table>
        <h4 class="mb-3">D. Ekstra Kurikuler</h4>
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Kegiatan Ekstra Kurikuler</th>
              <th class="text-center">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            @if ($ekstra->count() > 0)
              @foreach ($ekstra as $data)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $data->ekstra->nama_ekstra }}</td>
                  <td class="text-center">{{ $data->nilai }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-center">1</td>
                <td class="text-center"> - </td>
                <td class="text-center"> - </td>
              </tr>
            @endif
          </tbody>
        </table>
        <h4 class="mb-3">E. Ketidakhadiran</h4>
        <table class="table table-bordered table-striped table-hover">
          <tr>
            <td>Sakir</td>
            <td>- Hari</td>
          </tr>
          <tr>
            <td>Izin</td>
            <td>- Hari</td>
          </tr>
          <tr>
            <td>Tanpa Keterangan</td>
            <td>- Hari</td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>