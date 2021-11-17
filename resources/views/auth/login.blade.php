@extends('layouts.app')

@section('title')
  {{ __('تسجيل الدخول') }}
@endsection

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ route('home') }}"><b>Phone</b>LTE</a>
    </div>
    <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">{{ __('نظام Phone Lite لادارة محلات المحمول و الصيانه') }}</p>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

              <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="row">
                <div class="col-12">
                    <div class="checkbox">
                      <label for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('تذكرنى') }}
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-block btn-primary">
                        {{ __('تسجيل الدخول') }}
                    </button>
                </div>
                <div class="col-12 mt-2">
                    <a href="{{ route('register') }}" class="btn btn-block btn-success">
                        {{ __('إنشاء حساب جديد') }}
                    </a>
                </div>
                <div class="col-12 text-center">
                  @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('هل نسيت كلمة المرور؟') }}
                      </a>
                  @endif
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
@endsection
