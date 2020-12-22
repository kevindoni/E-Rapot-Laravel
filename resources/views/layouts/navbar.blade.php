@if (Auth::user()->level == "Siswa" || Auth::user()->level == "Guru")
  <nav class="navbar navbar-expand navbar-dark navbar-indigo">
    <div class="container">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{ url('/') }}" style="color: #fff; margin-right: 40px;">
            <img alt="image" src="{{ Storage::url($profile->logo_sekolah) }}" alt="Logo" class="rounded-circle mr-2 foto-navbar">
            <div class="d-inline-block font-weight-bold">E - Rapot</div>
          </a>
        </li>
      </ul>
  
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item" style="width: 100% !important">
          <div class="btn-group" role="group">
            <a id="btnGroupDrop1" style="color: #fff; margin-right: 40px;" type="button" class="dropdown-toggle text-capitalize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img alt="image" src="{{ asset('img/male.jpg') }}" class="rounded-circle mr-2 foto-navbar">
              <div class="d-inline-block text-capitalize">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i> &nbsp; Log Out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
@else
  <nav class="main-header navbar navbar-expand navbar-dark navbar-indigo">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item" style="width: 100% !important">
        <div class="btn-group" role="group">
          <a id="btnGroupDrop1" style="color: #fff; margin-right: 40px;" type="button" class="dropdown-toggle text-capitalize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img alt="image" src="{{ asset('img/male.jpg') }}" class="rounded-circle mr-2 foto-navbar">
            <div class="d-inline-block text-capitalize">{{ Auth::user()->name }}</div>
          </a>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i> &nbsp; Log Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </nav>
@endif