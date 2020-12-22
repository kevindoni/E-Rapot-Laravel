@extends('layouts.app')
@push('title', 'Siswa')
@push('page')
  <li class="breadcrumb-item active">Siswa</li>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambah-siswa">
            <i class="nav-icon fas fa-plus"></i> &nbsp; Tambah
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @livewire('siswa-livewire')
        </div>
      </div>
    </div>
  </div>

  <!-- Add modal -->
  <div class="modal fade bd-example-modal-lg tambah-siswa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Siswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('siswa.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nama_siswa">Nama Siswa</label>
                  <input type="text" id="nama_siswa" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" placeholder="Nama Siswa" required>
                </div>
                <div class="form-group">
                  <label for="no_induk">No Induk</label>
                  <input type="text" id="no_induk" name="no_induk" onkeypress="return inputAngka(event)" class="form-control @error('no_induk') is-invalid @enderror" placeholder="No Induk Siswa" required>
                </div>
                <div class="form-group">
                  <label for="nisn">NISN</label>
                  <input type="text" id="nisn" name="nisn" onkeypress="return inputAngka(event)" class="form-control @error('nisn') is-invalid @enderror" placeholder="NISN Siswa" required>
                </div>
                <div class="form-group">
                  <label for="jk">Jenis Kelamin</label>
                  <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                    @foreach ($jk as $data)
                      <option value="{{ $data }}">{{ $data }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="agama">Agama</label>
                  <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Agama --</option>
                    @foreach ($agama as $data)
                      <option value="{{ $data }}">{{ $data }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="status_keluarga">Status Keluarga</label>
                  <select id="status_keluarga" name="status_keluarga" class="select2bs4 form-control @error('status_keluarga') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Status Keluarga --</option>
                    @foreach ($keluarga as $data)
                      <option value="{{ $data }}">{{ $data }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="anak_ke">Anak Ke</label>
                  <input type="text" id="anak_ke" name="anak_ke" onkeypress="return inputAngka(event)" class="form-control @error('anak_ke') is-invalid @enderror" placeholder="Anak Ke" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat Siswa</label>
                  <textarea id="alamat" name="alamat" style="height: 125px;" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Siswa" required></textarea>
                </div>
                <div class="form-group">
                  <label for="telp">No Telepon</label>
                  <input type="text" id="telp" name="telp" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror" placeholder="No Telepon" required>
                </div>
                <div class="form-group">
                  <label for="asal_sekolah">Asal Sekolah</label>
                  <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" placeholder="Asal Sekolah" required>
                </div>
              </div>
            </div> <hr>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nama_ayah">Nama Ayah</label>
                  <input type="text" id="nama_ayah" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Nama Ayah" required>
                </div>
                <div class="form-group">
                  <label for="nama_ibu">Nama Ibu</label>
                  <input type="text" id="nama_ibu" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="Nama Ibu" required>
                </div>
                <div class="form-group">
                  <label for="alamat_ortu">Alamat Orang Tua</label>
                  <textarea id="alamat_ortu" name="alamat_ortu" style="height: 125px;" class="form-control @error('alamat_ortu') is-invalid @enderror" placeholder="Alamat Orang Tua" required></textarea>
                </div>
                <div class="form-group">
                  <label for="telp_ortu">No Telepon Orang Tua</label>
                  <input type="text" id="telp_ortu" name="telp_ortu" onkeypress="return inputAngka(event)" class="form-control @error('telp_ortu') is-invalid @enderror" placeholder="No Telepon Orang Tua" required>
                </div>
                <div class="form-group">
                  <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                  <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" placeholder="Pekerjaan Ayah" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                  <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" placeholder="Pekerjaan Ibu" required>
                </div>
                <div class="form-group">
                  <label for="nama_wali">Nama Wali</label>
                  <input type="text" id="nama_wali" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" placeholder="Nama Wali">
                </div>
                <div class="form-group">
                  <label for="alamat_wali">Alamat Wali</label>
                  <textarea id="alamat_wali" name="alamat_wali" style="height: 125px;" class="form-control @error('alamat_wali') is-invalid @enderror" placeholder="Alamat Wali"></textarea>
                </div>
                <div class="form-group">
                  <label for="telp_wali">No Telepon Wali</label>
                  <input type="text" id="telp_wali" name="telp_wali" onkeypress="return inputAngka(event)" class="form-control @error('telp_wali') is-invalid @enderror" placeholder="No Telepon Wali">
                </div>
                <div class="form-group">
                  <label for="pekerjaan_wali">Pekerjaan Wali</label>
                  <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" class="form-control @error('pekerjaan_wali') is-invalid @enderror" placeholder="Pekerjaan Wali">
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
    $("#DataMaster").addClass("active");
    $("#liDataMaster").addClass("menu-open");
    $("#DataSiswa").addClass("active");

    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })

    function inputAngka(event) {
      var charCode = (event.which) ? event.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }
      return true;
    }
  </script>
@endpush
