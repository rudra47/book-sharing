@extends('layouts.default')

@section('content')
<!-- Reset Email Verify page-->
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
            <form method="POST" action="{{ route('password.email', app()->getLocale()) }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <button type="submit" class="btn btn btn-primary"> Send Password Reset Link </button>
            </form>
        </div>
      </div>
    </div>
</section>
@endsection
