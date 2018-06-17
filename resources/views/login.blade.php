<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/login.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col s12 m4 offset-m4 l4 offset-l4 v-center">
					<form class="form-horizontal" action="{{ route('login') }}" method="post">
						<img id="logo" src="{{ asset('/images/uplogo.png') }}" alt="logo">
						<h1><span>CAS</span><span>DMS</span></h1>
						@csrf
						<section class="input-field">
							<i class="material-icons prefix small">account_circle</i>
							<input id="username" type="text" name="username" value="" placeholder="USERNAME" class="validate form-control{{ $errors->has('username') ? ' is-invalid' : '' }}">
							<!-- <label for="username">Username</label> -->
							@if ($errors->has('username'))
							  <span class="error helper-text">{{ $errors->first('username') }}</span>
							@endif
						</section>

						<section class="input-field">
							<i class="material-icons prefix small">lock</i>
							<input id="password" type="password" name="password" placeholder="PASSWORD" class="validate form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
							<!-- <label for="password">Password</label> -->
							@if ($errors->has('password'))
							  <span class="error helper-text">{{ $errors->first('password') }}</span>
							@endif
						</section>

						<button class="btn btn-block btn-default amber accent-4" name="submit" type="submit">login</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
