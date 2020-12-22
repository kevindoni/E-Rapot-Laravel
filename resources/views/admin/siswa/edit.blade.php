@extends('layouts.app')
@push('title', 'Edit Siswa')
@push('page')
  @if ($siswa->lulus == 'Belum Lulus')
    <li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></li>
  @else
    <li class="breadcrumb-item active"><a href="{{ route('lulus.index') }}">Siswa</a></li>
  @endif
  <li class="breadcrumb-item active">Edit</li>
@endpush
@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Siswa</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('siswa.store') }}" method="post">
        @csrf
        <div class="card-body">
          <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" value="{{ $siswa->nama_siswa }}" class="form-control @error('nama_siswa') is-invalid @enderror" placeholder="Nama Siswa" required>
              </div>
              <div class="form-group">
                <label for="no_induk">No Induk</label>
                <input type="text" id="no_induk" name="no_induk" value="{{ $siswa->no_induk }}" onkeypress="return inputAngka(event)" class="form-control @error('no_induk') is-invalid @enderror" placeholder="No Induk Siswa" required>
              </div>
              <div class="form-group">
                <label for="nisn">NISN</label>
                <input type="text" id="nisn" name="nisn" value="{{ $siswa->nisn }}" onkeypress="return inputAngka(event)" class="form-control @error('nisn') is-invalid @enderror" placeholder="NISN Siswa" required>
              </div>
              <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                  @foreach ($jk as $data)
                    <option value="{{ $data }}"
                      @if ($data == $siswa->jk)
                        selected
                      @endif
                    >{{ $data }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="agama">Agama</label>
                <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Agama --</option>
                  @foreach ($agama as $data)
                    <option value="{{ $data }}"
                      @if ($data == $siswa->agama)
                        selected
                      @endif
                    >{{ $data }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="status_keluarga">Status Keluarga</label>
                <select id="status_keluarga" name="status_keluarga" class="select2bs4 form-control @error('status_keluarga') is-invalid @enderror" required>
                  <option value="" disabled>-- Pilih Status Keluarga --</option>
                  @foreach ($keluarga as $data)
                    <option value="{{ $data }}"
                      @if ($data == $siswa->status_keluarga)
                        selected
                      @endif
                    >{{ $data }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="anak_ke">Anak Ke</label>
                <input type="text" id="anak_ke" name="anak_ke" value="{{ $siswa->anak_ke }}" onkeypress="return inputAngka(event)" class="form-control @error('anak_ke') is-invalid @enderror" placeholder="Anak Ke" required>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat Siswa</label>
                <textarea id="alamat" name="alamat" style="height: 125px;" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Siswa" required>{{ $siswa->alamat }}</textarea>
              </div>
              <div class="form-group">
                <label for="telp">No Telepon</label>
                <input type="text" id="telp" name="telp" value="{{ $siswa->telp }}" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror" placeholder="No Telepon" required>
              </div>
              <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ $siswa->asal_sekolah }}" class="form-control @error('asal_sekolah') is-invalid @enderror" placeholder="Asal Sekolah" required>
              </div>
            </div>
          </div> <hr>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="nama_ayah">Nama Ayah</label>
                <input type="text" id="nama_ayah" name="nama_ayah" value="{{ $siswa->nama_ayah }}" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Nama Ayah" required>
              </div>
              <div class="form-group">
                <label for="nama_ibu">Nama Ibu</label>
                <input type="text" id="nama_ibu" name="nama_ibu" value="{{ $siswa->nama_ibu }}" class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="Nama Ibu" required>
              </div>
              <div class="form-group">
                <label for="alamat_ortu">Alamat Orang Tua</label>
                <textarea id="alamat_ortu" name="alamat_ortu" style="height: 125px;" class="form-control @error('alamat_ortu') is-invalid @enderror" placeholder="Alamat Orang Tua" required>{{ $siswa->alamat_ortu }}</textarea>
              </div>
              <div class="form-group">
                <label for="telp_ortu">No Telepon Orang Tua</label>
                <input type="text" id="telp_ortu" name="telp_ortu" value="{{ $siswa->telp_ortu }}" onkeypress="return inputAngka(event)" class="form-control @error('telp_ortu') is-invalid @enderror" placeholder="No Telepon Orang Tua" required>
              </div>
              <div class="form-group">
                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ $siswa->pekerjaan_ayah }}" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" placeholder="Pekerjaan Ayah" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ $siswa->pekerjaan_ibu }}" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" placeholder="Pekerjaan Ibu" required>
              </div>
              <div class="form-group">
                <label for="nama_wali">Nama Wali</label>
                <input type="text" id="nama_wali" name="nama_wali" value="{{ $siswa->nama_wali }}" class="form-control @error('nama_wali') is-invalid @enderror" placeholder="Nama Wali">
              </div>
              <div class="form-group">
                <label for="alamat_wali">Alamat Wali</label>
                <textarea id="alamat_wali" name="alamat_wali" style="height: 125px;" class="form-control @error('alamat_wali') is-invalid @enderror" placeholder="Alamat Wali">{{ $siswa->alamat_wali }}</textarea>
              </div>
              <div class="form-group">
                <label for="telp_wali">No Telepon Wali</label>
                <input type="text" id="telp_wali" name="telp_wali" value="{{ $siswa->telp_wali }}" onkeypress="return inputAngka(event)" class="form-control @error('telp_wali') is-invalid @enderror" placeholder="No Telepon Wali">
              </div>
              <div class="form-group">
                <label for="pekerjaan_wali">Pekerjaan Wali</label>
                <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" class="form-control @error('pekerjaan_wali') is-invalid @enderror" placeholder="Pekerjaan Wali">
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          @if ($siswa->lulus == 'Belum Lulus')
            <a href="{{ route('siswa.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          @else
            <a href="{{ route('lulus.index') }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          @endif
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('script')
  @if ($siswa->lulus == 'Belum Lulus')
    <script>
      $("#DataMaster").addClass("active");
      $("#liDataMaster").addClass("menu-open");
      $("#DataSiswa").addClass("active");
    </script>
  @else
    <script>
      $("#SetData").addClass("active");
      $("#liSetData").addClass("menu-open");
      $("#SetLulus").addClass("active");
    </script>
  @endif

  <script type="text/javascript">
    function inputAngka(event) {
      var charCode = (event.which) ? event.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }
      return true;
    }
  </script>
@endpush