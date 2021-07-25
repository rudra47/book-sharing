@extends('layouts.default')

@section('content')
<!-- Login page-->
<section class="section-bottom-border login-signup">
    <div class="container">
      <div class="row">
        <div class="login-main template-form">
          <h4>Please Log In, or <a href="{{ route('register', app()->getLocale()) }}">Sign Up</a></h4>
          <div class="template-space"></div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6"> <a href="{{ route('login.facebook') }}" class="btn btn-facebook btn-block">Facebook</a> </div>
            <div class="col-xs-6 col-sm-6 col-md-6"> <a href="#" class="btn btn-google btn-block">Google</a> </div>
          </div>
          <div class="login-or">
            <hr class="hr-or">
            <span class="span-or">or</span> </div>
          <form method="POST" action="{{ route('login', app()->getLocale()) }}">
            @csrf
            <div class="form-group">
                <label for="email">Username or email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group">
                @if (Route::has('password.request'))
                    <a class="pull-right" href="{{ route('password.request', app()->getLocale()) }}">
                        Forgot password?
                    </a>
                @endif
                <label for="inputPassword">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="checkbox pull-right">
              <label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember me </label>
            </div>
            <button type="submit" class="btn btn btn-primary"> Log In </button>
          </form>
        </div>
      </div>
    </div>
</section>
@endsection
