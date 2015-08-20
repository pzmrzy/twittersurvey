<?php
	session_start();
	if (isset($_GET['action']) && $_GET['action'] == "logout") {
		unset($_SESSION['user']);
		echo 'Logout, Click here for<a href="login.html">Login</a>';
		exit;
	}


$user = htmlspecialchars($_POST['username']);
$pass = $_POST['password'];

if ($user == ""){
	$_SESSION['error'] = "Please fill in your username.";
	header("Location: login.php");
	exit;
}else {
	if ($pass == ""){
		$_SESSION['user'] = $user;
		$_SESSION['error'] = "Please fill in your password.";
		header("Location: login.php");
		exit;
	}
}

if (substr( $user, 0, 1 ) == "@"){
	$user = substr($user, 1);
}



require('conn.php');
include('lib.php');

$check_query = mysql_query("SELECT `password` FROM `users` WHERE `user_name`='$user'");
if ($result = mysql_fetch_array($check_query)){
	//error_log($result[0]);
	if ($result[0] == '' || is_null($result[0])){
		$_SESSION['user'] = $user;
		$_SESSION['batch_num'] = get_batch_num($user);
		//update
		$save_query = "UPDATE users SET password='$pass' WHERE user_name='$user'";
		error_log($save_query);
		mysql_query($save_query) or die(mysql_error());
		error_log($save_query);
		header("Location: question1.php?batch=1");
		exit;
	}else{
		$check_query = mysql_query("SELECT * FROM `users` WHERE `user_name`='$user' AND password='$pass' LIMIT 1");
		if ($result = mysql_fetch_array($check_query)){
			$_SESSION['user'] = $user;
			$_SESSION['batch_num'] = get_batch_num($user);
			header("Location: question1.php?batch=1");
			exit;
		}else{
			$_SESSION['error'] = "Your password does not match with your username. Please contact felician.2013@smu.edu.sg";
			header("Location: login.php");
			exit;

		}
	}
}else{
	//exit('login fail, click here for <a href="javascript:history.back(-1);">back</a>.');
	$_SESSION['error'] = "Your username does not exist. Please contact felician.2013@smu.edu.sg";
	header("Location: login.php");
	exit;
}

?>