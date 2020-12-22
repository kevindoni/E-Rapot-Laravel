@extends('auth.app')
@push('title', 'Login')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">Sign in to start your session</p>

  <form action="{{ route('login') }}" method="post">
    @csrf
    <div class="input-group mb-3">
      <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('Username') }}" name="username" autofocus>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
      @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>Maaf Username Anda Salah</strong>
        </span>
      @enderror
    </div>
    <div class="input-group mb-3">
      <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>Maaf Password Anda Salah</strong>
        </span>
      @enderror
    </div>
    <div class="row mb-1">
      <div class="col-7">
        <div class="icheck-primary">
          <input type="checkbox" id="remember" class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          <label for="remember">
            {{ __('Remember Me') }}
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-5">
        <button type="submit" id="btn-login"class="btn btn-primary btn-block">{{ __('Login') }} &nbsp; <i class="nav-icon fas fa-sign-in-alt"></i></button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</div>
@endsection