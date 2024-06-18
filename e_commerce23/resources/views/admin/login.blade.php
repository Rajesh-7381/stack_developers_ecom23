<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		.loader
		{
		  background: rgba( 255, 255, 255, 0.8 );
		  display: none;
		  height: 100%;
		  position: fixed;
		  width: 100%;
		  z-index: 9999;
		}
		
		.loader img
		{
		  left: 50%;
		  margin-left: -32px;
		  margin-top: -32px;
		  position: absolute;
		  top: 50%;
		  width: 64px; /* Adjust to the desired width */
          height: 64px;
		}
		</style>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('admin-assets/css/adminlte.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/css/custom.css')}}">
</head>

<body class="hold-transition login-page">
	<div class="loader">
		{{-- <img src="{{asset('frontend/images/loader3.gif')}}" alt="loading..." /> --}}
		<img src="https://i.gifer.com/ZKZg.gif" alt="loading..." />
	 </div> 

	<div class="login-box">
		<!-- /.login-logo -->

		<div class="card card-outline card-primary">
			<div class="card-header text-center bg-success">
				<a href="#" class="h3 ">Administrative Panel</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Sign in to start your session</p>
				@if (session('error_message'))
				<div class="alert alert-danger">
					{{ session('error_message') }}
				</div>
				@endif
				@if (session('success_message'))
				<div class="alert alert-success">
					{{ session('success_message') }}
				</div>
				@endif
				<form action="{{url('admin/login')}}" method="post" id="formid">
					@csrf
					<div class="input-group mb-3">
						<input type="email" name="email" id="email" class="form-control" autocomplete="username"
							placeholder="Email" @if(isset($_COOKIE['email'])) value="{{$_COOKIE['email']}}" @endif>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>

					</div>

					<div class="input-group mb-3 password-input-container">
						<input type="password" placeholder="Password" name="password" id="password" autocomplete="current-password"
							class="form-control" placeholder="Password" @if(isset($_COOKIE['password']))
							value="{{$_COOKIE['email']}}" @endif>

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="toggle-password fas fa-eye" onclick="togglePasswordVisibility('password')"></span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember" name="remember" @if(isset($_COOKIE['email']))
									checked="" @endif>
								<label for="remember">
									Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
							<br>
						</div>
						<!-- Add your login form as before -->



						<!-- /.col -->
					</div>
					<!-- Facebook and Google login buttons -->
					<div class="social-login">
						<a href="" class="btn btn-primary btn-block">
							<i class="fab fa-facebook"></i> Login with Facebook
						</a>

						<a href="" class="btn btn-danger btn-block">
							<i class="fab fa-google"></i> Login with Google
						</a>
						<a href="#" class="btn btn-secondary btn-block">
							<i class="fab fa-github"></i> Login with GitHub
						</a>

					</div>
				</form>
				<p class="mb-1 mt-3">
					<a href="forgot-password.html">I forgot my password</a>
				</p>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- ./wrapper -->
	<!-- jQuery -->
	<script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('admin-assets/js/adminlte.min.js')}}"></script>
	<!-- AdminLTE for demo purposes -->
	{{-- <script src="js/demo.js"></script> --}}
	<script>
		
        function togglePasswordVisibility(passwordFieldId) {
            var passwordField = document.getElementById(passwordFieldId);
            var eyeIcon = document.querySelector('.toggle-password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
		$(document).ready(function(){
      $("#formid").on("submit", function(){
        $(".loader").show();
      });//submit
    });//document ready
   
	</script>
</body>

</html>
