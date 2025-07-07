<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset Password | BookCMS</title>
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
    <p class="login-box-msg">Reset your password</p>

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

    <form method="POST" action="{{ route('password.update') }}">
  @csrf

  {{-- Directly use passed $token and $email --}}
  <input type="hidden" name="token" value="{{ $token }}">
  
  <div class="form-group has-feedback">
    <input type="email" name="email" class="form-control" placeholder="Email"
      value="{{ old('email', $email) }}" required autofocus>
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>

  <div class="form-group has-feedback">
    <input type="password" name="password" class="form-control" placeholder="New Password" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>

  <div class="form-group has-feedback">
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required>
    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
</form>

    <br>
    <a href="{{ route('admin.login') }}"><i class="fa fa-arrow-left"></i> Back to Login</a>
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
