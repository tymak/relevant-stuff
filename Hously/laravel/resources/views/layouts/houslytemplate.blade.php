<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Welcome to Hously')</title>
    <script src="https://api.mapy.cz/loader.js"></script>
	<script>Loader.load()</script>
    <link rel="stylesheet" href="css/app.css">
    @yield('styles','')
    
    <!-- Laravel AUTH STYLES and SCRIPTS: -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- END  -->

    <!-- VEGAS Library: -->
    <link rel="stylesheet" href="/vendor/vegas/vegas.min.css">

    

</head>
<body>
    <header>
        <nav>
            <div class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="/"><img src="../img/hously-logo.svg" alt="logo"> Hously</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ml-3" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                    @yield('nav')
                    </ul>
                    <div class="navbar-text">
                        @guest
                        <div id="login__open"> <a class="nav-link" href="#">Login</a></div>
                        <div id="register__open"><a class="nav-link" href="#">Register</a></div>
                        @else
                        <div><a href="/app/dashboard">{{ Auth::user()->first_name }}</a>
                            <a href="{{ route('logout') }}"
                                onclick="
                                event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <img src="/img/logout__ico.svg" alt="logout">
                            </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>                            
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
        
    </header>
    <div class="auth__overlay">
        <div class="auth__overlay__modal modal__login">
            <div class="auth__overlay__modal__close" id="login__close">X</div>
            <h4>Log in to your account</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email" required autocomplete="email" autofocus>
                @error('email')
                            <span class="invalid-feedback" role="alert">
                                <script> 
                                    document.querySelector('body').classList.add('modal__open');
                                    document.querySelector('.auth__overlay').classList.add('modal__open');
                                    document.querySelector('.modal__login').classList.add('modal__open');
                               </script>
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password" required autocomplete="current-password">
                @error('password')
                <script> 
                        document.querySelector('body').classList.add('modal__open');
                        document.querySelector('.auth__overlay').classList.add('modal__open');
                        document.querySelector('.modal__login').classList.add('modal__open');
                </script>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
                
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <br>    
                <a class="btn btn-link text-dark" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
        <div class="auth__overlay__modal modal__register ">
                <div class="auth__overlay__modal__close" id="register__close">X</div>
                <h4>Register new account</h4>
                <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date" autofocus>

                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form> 
        </div>
    </div>
    @yield('content')
    <footer>
        <div>© 2019 Hously</div>
    </footer> 
    <script src="/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="/vendor/vegas/vegas.js"></script>
    <script src="/js/hously.js"></script>
</body>
</html>