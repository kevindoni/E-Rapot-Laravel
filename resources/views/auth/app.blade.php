@php( $profile = \App\Models\Profile::find(1) )
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>E - Rapot | @stack('title')</title>
  <link rel="shrotcut icon" href="{{ Storage::url($profile->logo_sekolah) }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <style>
    body {
      font-family: Arial;
    }

    h2 {
      font-weight: bold;
    }

    /* .login-box {
      width: 500px;
    } */
  </style>
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset("img/wallup.jpg") }}'); background-size: cover; background-attachment: fixed;">
  <div class="col-md-6">
    <div class="login-logo" style="margin-top: -20px">
      <h2 class="text-white">
        <img src="{{ asset('img/favicon.png') }}" height="50px" alt="">
        {{ $profile->nama_sekolah }}
      </h2>
    </div>

    <div class="card mt-2 col-md-8 mx-auto">
      @yield('content')
    </div>

    <footer class="text-white">
      <marquee>
          <strong>
            Copyright &copy;
            @if (date('Y') == "2020")
                {{ date('Y') }}
            @else
                2020 - {{ date('Y') }}
            @endif
            &diams; <a href="#" style="color: white;">{{ $profile->nama_sekolah }}</a>.
          </strong>
      </marquee>
    </footer>
  </div>

  <!-- page script -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  @if (count($errors)>0)
    <script>
      toastr.error("Maaf Username atau Password Salah!");
    </script>
  @endif
</body>
</html>