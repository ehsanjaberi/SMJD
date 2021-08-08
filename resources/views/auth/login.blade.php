<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>صفحه ورود</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!--Icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="login-logo my-5 d-flex justify-content-center">
                <span class="fa fa-university text-white fa-3x"></span>
            </div>
            <div class="card card-signin">
                <div class="card-body text-right">
                    <h5 class="card-title text-center">ورود به حساب کاربری</h5>
                    <form class="form-signin" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-label-group">
                            <span class="fa fa-user @error('Username') text-danger @enderror" style="position: absolute;left: 14px;top: 50%;transform: translate(-50%, -50%);"></span>
                            <input type="text" id="Username" name="Username" class="form-control" placeholder="نام کاربری" required autofocus>
                            <label for="Username">نام کاربری</label>
                        </div>
                        @error('Username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-label-group">
                            <span class="fa fa-key @error('Username') text-danger @enderror" style="position: absolute;left: 14px;top: 50%;transform: translate(-50%, -50%);"></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="رمز عبور" required>
                            <label for="password">رمز عبور</label>
                        </div>
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <button class="btn btn-lg btn-primary btn-block text-uppercase rounded" type="submit">
                            <i class="fa fa-lock"></i>
                            ورود
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
