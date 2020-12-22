@php( $profile = \App\Models\Profile::find(1) )
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E - Rapot | @stack('title')</title>
    <link rel="shrotcut icon" href="{{ Storage::url($profile->logo_sekolah) }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- styles css -->
    <style>
      .foto-navbar {
        width: 30px;
        height: 30px;
        object-fit: cover;
      }

      .search-table label,
      .paginate-length label {
        font-weight: normal;
        white-space: nowrap;
        text-align: left;
      }

      .search-table label input,
      .paginate-length label select {
        display: inline-block;
        width: auto;
      }

      thead > tr > th, tbody > tr > td{
        vertical-align: middle !important;
      }

      .callout {
        border: 1px solid #dee2e6;
        box-shadow: none;
      }
    </style>

    @livewireStyles
    @stack('styles')
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    @if (Auth::user()->level == "Siswa" || Auth::user()->level == "Guru")
      <!-- Navbar -->
      @include('layouts.navbar')
      <!-- /.navbar -->

      <section class="content">
        <div class="container-fluid">
          <div class="container">
          @yield('content')
          </div>
        </div>
      </section>
    @else
      <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">@stack('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    @stack('page')
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              @yield('content')
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
          <marquee>
            <strong>
              Copyright &copy;
              @if (date('Y') == "2020")
                  {{ date('Y') }}
              @else
                  2020 - {{ date('Y') }}
              @endif
              &diams; <a href="#">{{ $profile->nama_sekolah }}</a>.
            </strong>
          </marquee>
        </footer>
      </div>
      <!-- ./wrapper -->
    @endif

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    @livewireScripts
    @stack('script')

    @if (count($errors)>0)
      @foreach ($errors->all() as $error)
        <script>
          toastr.error("{{ $error }}");
        </script>
      @endforeach
    @endif
    @if (Session::has('success'))
      <script>
        toastr.success("{{ Session('success') }}");
      </script>
    @endif
    @if (Session::has('error'))
      <script>
        toastr.error("{{ Session('error') }}");
      </script>
    @endif
  </body>
</html>
