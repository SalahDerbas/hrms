<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page"  style="background-image: url({{asset('assets/img/Logo.png')}});background-repeat: no-repeat;background-position: bottom right;background-size: 195px;  background-attachment: fixed;">

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <p class="h1" style="color: #007bff">{{ config('app.name', 'Laravel') }}</p>
        </div>
        <div class="card-body">
            <h3 class="login-box-msg">Login To {{ config('app.name', 'Laravel') }} </h3>

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
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- /.social-auth-links -->
            <br>

            @if (Route::has('password.request'))
                <p class="login-box-msg" style="padding:0px;"><a class="btn btn-warning" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a> </p>
            @endif

            <br>

            <p class="login-box-msg" style="padding:0px;"> <a href="/register" class="btn btn-info">Register Now !!</a> </p>



        <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
    <br><br>
        <strong>{{trans('trans.Copyright')}} &copy; 2017-2023 <a href="https://nextstagejo.com/"  target="_blank">  <img src="{{asset('assets/img/Logo.png')}}" alt="Logo"  style="opacity: .8; width:18px;height:18px; margin-left: 18px;">   {{trans('trans.Next_Stage_Company')}}</a></strong>

</div>

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
