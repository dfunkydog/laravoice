@extends('layouts.app') 
@section('content')
<section class="section">
    <div class="card-header">{{ __('Login') }}</div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="">{{ __('E-Mail Address') }}</label>

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                required autofocus> @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span> @endif
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                required> @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span> @endif
        </div>

        <div class="form-group ">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

            <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
        </div>
    </form>
</section>
</div>
@endsection