@extends('layouts.app')

@section('title')
  {{ __('انشاء مستخدم جديد') }}
@endsection

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ route('home') }}"><b>Phone</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('تسجيل مستخدم جديد') }}</p>
          <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="input-group mb-3">
                <input id="name" type="text" placeholder="{{ __('أكتب اسم المستخدم هنا') }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="input-group mb-3">
                <input id="email" placeholder="{{ __('أكتب البريد الالكتروني') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                <input id="password" placeholder="{{ __('أكتب كلمة السر هنا') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-key"></span>
                  </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="input-group mb-3">
                <input id="password-confirm"  placeholder="{{ __('أعد كتابة كلمة المرور') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-redo-alt"></span>
                  </div>
                </div>
              </div>

              <div class=" mt-2">
                  <button type="submit" class="btn btn-block btn-success">
                      {{ __('إنشاء حساب جديد') }}
                  </button>
              </div>
              <div class=" mt-2">
                  <a href="{{ route('login') }}" class="btn btn-block btn-primary">
                      {{ __('لدي حساب بالفعل') }}
                  </a>
              </div>
          </form>
      </div>
    </div>
  </div>
@endsection
