@extends('layouts.app')
@push('title', 'Dashboard')
@push('styles')
  <style>
    a.small-box-footer,
    a.small-box-footer:hover,
    .icon i {
      color: #212529 !important;
    }
  </style>
@endpush
@section('content')
  <div class="row">
    <div class="col-12 mb-3">
      <h3 class="title text-center"><b>Selamat Datang</b><br>
      Anda Login sebagai : {{ Auth::user()->level }}<br></h3>
    </div>
    @if (Auth::user()->level == "Admin")
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>
              @if ($tahun == true)
                {{ $tahun->semester }} 
                @if ($tahun->semester == 'Ganjil')
                  {{ $tahun->tahun }}/{{ $tahun->tahun+1 }}
                @else
                  {{ $tahun->tahun-1 }}/{{ $tahun->tahun }}
                @endif
              @else
              Semester Tahun
              @endif
            </h3>
            <p>Tahun Akademik</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-check nav-icon"></i>
          </div>
          <a href="{{ route('tahun.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>{{ $ekstra }}</h3>
            <p>Ekstrakurikuler</p>
          </div>
          <div class="icon">
            <i class="fas fa-basketball-ball nav-icon"></i>
          </div>
          <a href="{{ route('ekstra.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>{{ $guru }}</h3>
            <p>Guru</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-secret nav-icon"></i>
          </div>
          <a href="{{ route('guru.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-6">
          <div class="small-box shadow">
              <div class="inner">
                  <h3>{{ $prodi }}</h3>
                  <p>Jurusan</p>
              </div>
              <div class="icon">
                  <i class="fas fa-book-reader nav-icon"></i>
              </div>
              <a href="{{ route('prodi.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>{{ $kelas }}</h3>
            <p>Kelas</p>
          </div>
          <div class="icon">
            <i class="fas fa-home nav-icon"></i>
          </div>
          <a href="{{ route('kelas.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>{{ $mapel }}</h3>
            <p>Mata Pelajaran</p>
          </div>
          <div class="icon">
            <i class="fas fa-book nav-icon"></i>
          </div>
          <a href="{{ route('mapel.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>{{ $siswa }}</h3>
            <p>Siswa</p>
          </div>
          <div class="icon">
            <i class="fas fa-users nav-icon"></i>
          </div>
          <a href="{{ route('siswa.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>{{ $user }}</h3>
            <p>User</p>
          </div>
          <div class="icon">
            <i class="fas fa-user nav-icon"></i>
          </div>
          <a href="{{ route('user.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    @elseif (Auth::user()->level == "Wali Kelas")
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>
              @if ($tahun == true)
                {{ $tahun->semester }} 
                @if ($tahun->semester == 'Ganjil')
                  {{ $tahun->tahun }}/{{ $tahun->tahun+1 }}
                @else
                  {{ $tahun->tahun-1 }}/{{ $tahun->tahun }}
                @endif
              @else
              Semester Tahun
              @endif
            </h3>
            <p>Tahun Akademik</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-check nav-icon"></i>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="small-box shadow">
          <div class="inner">
            <h3>{{ $siswa }}</h3>
            <p>Siswa</p>
          </div>
          <div class="icon">
            <i class="fas fa-users nav-icon"></i>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection
@push('script')
  <script>
    $("#Dashboard").addClass("active");
  </script>
@endpush
