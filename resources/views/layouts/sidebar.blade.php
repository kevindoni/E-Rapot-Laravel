<aside class="main-sidebar elevation-4 sidebar-light-indigo">
  <!-- Brand Logo -->
  <a href="{{ url('/') }}" class="brand-link">
    <img src="{{ Storage::url($profile->logo_sekolah) }}" alt="Logo" class="brand-image img-circle elevation-1">
    <span class="brand-texty ml-3">E - Rapot</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link" id="Dashboard">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @if (Auth::user()->level == "Admin")
          <li class="nav-item has-treeview" id="liDataMaster">
            <a href="#" class="nav-link" id="DataMaster">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ekstra.index') }}" class="nav-link" id="DataEkstra">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ekstra</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('guru.index') }}" class="nav-link" id="DataGuru">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('prodi.index') }}" class="nav-link" id="DataProdi">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jurusan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('kelas.index') }}" class="nav-link" id="DataKelas">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('mapel.index') }}" class="nav-link" id="DataMapel">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('siswa.index') }}" class="nav-link" id="DataSiswa">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link" id="DataUser">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview" id="liSetData">
            <a href="#" class="nav-link" id="SetData">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Set Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('jadwal.index') }}" class="nav-link" id="SetJadwal">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('kelas-mapel.index') }}" class="nav-link" id="SetKelasMapel">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas Mapel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('kelas-siswa.index') }}" class="nav-link" id="SetKelasSiswa">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('lulus.index') }}" class="nav-link" id="SetLulus">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lulus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('predikat.index') }}" class="nav-link" id="SetPredikat">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Predikat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('tahun.index') }}" class="nav-link" id="SetTahun">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tahun</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.rapot.index') }}" class="nav-link" id="AdminRapot">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>Nilai Rapot Siswa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setting') }}" class="nav-link" id="SetProfile">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
              </p>
            </a>
          </li>
        @elseif (Auth::user()->level == "Wali Kelas")
          <li class="nav-item">
            <a href="{{ route('catatan.index') }}" class="nav-link" id="Catatan">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Catatan Akademik
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('magang.index') }}" class="nav-link" id="Magang">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Nilai PKL
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('nilai-ekstra.index') }}" class="nav-link" id="NilaiEkstra">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Nilai Ekstra
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('wali.rapot') }}" class="nav-link" id="WaliRapot">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>Nilai Rapot Siswa</p>
            </a>
          </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>