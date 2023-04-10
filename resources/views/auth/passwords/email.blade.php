<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{asset('assets/img/Logo.png')}}" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page" style="background-image: url({{asset('assets/img/Logo.png')}});background-repeat: no-repeat;background-position: bottom right;background-size: 195px;  background-attachment: fixed;">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <p class="h1" style="color: #007bff">{{ config('app.name', 'Laravel') }}</p>
        </div>
        <div class="card-body">
            <h4 class="login-box-msg">You Forgot your password? </h4>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="/login"  class="btn btn-warning">Go To Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

    <br><br>
    <strong>{{trans('trans.Copyright')}} &copy; 2017-2023 <a href="{{env('APP_Company_URL')}}"  target="_blank">  <img src="{{asset('assets/img/Logo.png')}}" alt="Logo"  style="opacity: .8; width:18px;height:18px; margin-left: 18px;">   {{env('APP_Company')}}</a></strong>



</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
</body>
</html>























