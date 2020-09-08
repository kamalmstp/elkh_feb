<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="{{ asset('img/logo.png') }}" rel="shortcut icon">
</head>

<body>

	<div class="navbar navbar-fixed-top">	
		<div class="navbar-inner">
			<div class="container">								
				<a class="brand" href="#" >
					<i style="font-size: 1.5em;">e</i> - LKH & SKP FEB
				</a>									
			</div> <!-- /container -->
		</div> <!-- /navbar-inner -->	
	</div> <!-- /navbar -->

	<div class="account-container">		
		<div class="content clearfix">
			<form method="POST" action="{{ route('login') }}">
				{{ csrf_field() }}
				@if ($errors)
				  @foreach($errors->all() as $error)
				    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
				  @endforeach
				@endif
				<h1>User Login</h1>		
				<div class="login-fields">
					<div class="field">
						<label >Email</label>
						<input type="text" name="email" placeholder="Email" class="login username-field" value="{{ old('email') }}" autofocus required/>
					</div> <!-- /field -->					
					<div class="field">
						<label >Password:</label>
						<input type="password" name="password" value="" placeholder="Password" class="login password-field" required/>
					</div> <!-- /password -->										
				</div> <!-- /login-fields -->
				<button class="button btn btn-success btn-large" type="submit">Sign In</button>				
			</form>			
		</div> <!-- /content -->		
	</div> <!-- /account-container -->

  	<script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>   
  	<script src="{{ asset('js/bootstrap.js') }}"></script> 
	<script src="{{ asset('js/signin.js') }}"></script>

</body>

</html>
