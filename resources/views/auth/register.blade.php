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
<body class="hold-transition register-page" style="background-image: url({{asset('assets/img/Logo.png')}});background-repeat: no-repeat;background-position: bottom right;background-size: 195px;  background-attachment: fixed;">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <p class="h1" style="color: #007bff">{{ config('app.name', 'Laravel') }}</p>
        </div>
        <div class="card-body">
            <h4 class="login-box-msg">Register Now in {{ config('app.name', 'Laravel') }} </h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <input id="firstname" placeholder="First Name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required autocomplete="firstname">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <input id="lastname" placeholder="Last Name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autocomplete="lastname">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <input id="phone" placeholder="Phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                    </div>

                </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                </div>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <input id="password-confirm" placeholder="Confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group mb-3">

                            <select id="material_status" name="material_status" class="form-select form-control" style="width: 74%;">
                                <option selected value="Single">Single</option>
                                <option value="Married">Married</option>
                            </select>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">

                            <select id="gender" name="gender" class="form-select form-control" style="width: 74%;">
                                <option selected value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="/login" class="text-center">I already have account</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

    <br><br>
    <strong>{{trans('trans.Copyright')}} &copy; 2017-2023 <a href="https://nextstagejo.com/"  target="_blank">  <img src="{{asset('assets/img/Logo.png')}}" alt="Logo"  style="opacity: .8; width:18px;height:18px; margin-left: 18px;">   {{trans('trans.Next_Stage_Company')}}</a></strong>

</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
</body>
</html>

