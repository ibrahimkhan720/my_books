<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | BookCMS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('admin/assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Book</b>CMS</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    {{-- Flash Message --}}
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row" style="display: flex">
        <div class="col-xs-8" style="margin-left: 4px">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

      <a href="{{ route('password.request') }}">I forgot my password</a><br>
  </div>
</div>

<!-- JS Files -->
<script src="{{ asset('admin/assets/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('admin/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('admin/assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/assets/dist/js/app.min.js') }}"></script>
<script src="{{ asset('admin/assets/dist/js/demo.js') }}"></script>

</body>
</html>
