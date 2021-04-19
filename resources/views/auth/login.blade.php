@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center mt-5 pt-5">
        <div class="col-md-12">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">

                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>


                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3 ">
                        <div class="form-check d-flex justify-content-between">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Log me in') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center fixed-bottom mb-3">
        <footer>
            Copyright &copy; 2020 Eprayogia
        </footer>
    </div>
</div>
@endsection