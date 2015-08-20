<?php
	session_start();
	if (isset($_GET['action']) && $_GET['action'] == "logout") {
		unset($_SESSION['user']);
		echo 'Logout, Click here for<a href="login.html">Login</a>';
		exit;
	}


$user = htmlspecialchars($_POST['username']);
$pass = $_POST['password'];



require('conn.php');
include('lib.php');
$check_query = mysql_query("SELECT `password` FROM `users` WHERE `user_name`='$user'");
if ($result = mysql_fetch_array($check_query)){
	if ($result[0] == 'NULL'){
		$_SESSION['user'] = $user;
		//update
		header("Location: question1.php?batch=1");
		exit;
	}
}

$check_query = mysql_query("SELECT * FROM `users` WHERE `user_name`='$user' AND password='$pass' LIMIT 1");
if ($result = mysql_fetch_array($check_query)){
	$_SESSION['user'] = $user;
	$_SESSION['batch_num'] = get_batch_num($user);
	
	header("Location: question1.php?batch=1");	
	exit;
} else {
	exit('login fail, click here for <a href="javascript:history.back(-1);">back</a>.');
}
?>