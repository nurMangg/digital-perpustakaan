@include('layout.header-component')

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <div class="card-body text-center">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" class="mb-4" style="width: 250px;">
            </div>
            <div class="card">
                
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            <a href="{{ route('register') }}" class="btn btn-secondary">
                                {{ __('Register') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer-component')
