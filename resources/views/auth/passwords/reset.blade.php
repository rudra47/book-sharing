@extends('layouts.default')

@section('content')
<!-- Reset Password page-->
<section class="section-bottom-border login-signup">
    <div class="container">
      <div class="row">
        <div class="login-main template-form">
          <h4>Reset Password</h4>
          <div class="template-space"></div>
          <div class="login-or">
            <hr class="hr-or">
            <span class="span-or">or</span> </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.update', app()->getLocale()) }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn btn btn-primary"> Reset Password </button>
            </form>
        </div>
      </div>
    </div>
</section>
@endsection
