@extends('layouts.app')

@section('content')
<div class="container">
</br>
<div class="card-group login">
     <div class="card logo animated fadeLeft" style="animation-delay:0s;">
           <div class="card-body text-center">
                  <img src="{{ asset('img/theme/logo.png') }}" class="img-fluid">     

           </div>
     </div>
  <div class="card form animated fadeLeft" style="animation-delay:1s;">
  </br>
  <h2 class="text-center" style="color: #3f3a73;font-size: 35px;font-weight: 600;"><span style="color: rgb(96 96 96 / 52%);
    ">L</span>ogin <span style="color: rgb(96 96 96 / 52%);
    ">S</span>ystem </h2>
  </br>
    <div class="card-body text-center">
    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" style="color: #2e2766;" class="col-md-4 col-form-label text-md-right">Email:</i></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="color: #2e2766;">Password:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn" id="login_btn">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
</div>
  </div>
 
  
</div>
</div>

@endsection
