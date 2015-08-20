<?php
	session_start();
	$error = "";
	if (isset($_SESSION['error'])){
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}
	$user = "";
	if (isset($_SESSION['user'])){
		$user = $_SESSION['user'];
		unset($_SESSION['user']);
	}


?>


<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<title>Twitter Network Survey</title>
</head>
<body>

	<div class="container">
		<h1 align="middle"><br/>Twitter Network Survey</h1>
		<form class="form-horizontal" action="check.php" method="post">
			<div class="row">
				<label class='col-md-4'></label>
				<?php
					echo "<label class='col-md-4'><font color='red'>".$error."</font></label><br/>";
				?>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Username</label>
				<div class="col-md-4">
					<?php
						echo "<input type='text' class='form-control' id='userName' name='username'
						placeholder='Input Twitter Username (NOT EMAIL!)' value='".$user."''>"
					?>
					
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Password</label>
				<div class="col-md-4">
					<input type="password" class="form-control" id="password" name ="password"
						placeholder="For first login, enter any string as a new password.">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-4">
					<div class="checkbox">
						<label><input type="checkbox" id="rememberUserNameChecked">Remember Username</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-4">
					<button type="submit" class="btn btn-primary" value="submit" onclick="return checkUsernamePassword()">Sign in</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>