<?php
	session_start();
	if (isset($_GET['action']) && $_GET['action'] == "logout") {
		unset($_SESSION['user']);
		echo 'Logout, Click here for<a href="login.html">Login</a>';
		exit;
	}
	$user = $_SESSION['user'];
	$save = $_POST['save'];
	list($question, $action) = explode("_", $save);
	//error_log($question);

	$friends = $_SESSION['friends'];
	$batch = $_SESSION['batch'];

	require('conn.php');
	include('lib.php');

	if ($question == 'question1'){
		if (is_numeric ($action)){

			foreach ($friends as $friend) {
				$id = $friend['id'];
				$radioname = 'radio'.$id;
				var_dump($_POST);
				$selected_relationship = $_POST[$radioname];
				error_log($friend['name']." ".$selected_relationship);
				if ($friend['relationship'] != 'NA' && $friend['relationship'] != 'Nonpersonal' && $friend['relationship'] != 'Irrelevant'){
					if ($friend['closeness'] > -1){
						$friend['closeness'] = -1; 
					}

					if ($friend['connection_start'] != "NA" || $friend['on_acq'] != "Unselected" || $friend['off_acq'] != "Unselected" || $friend['off_oft'] != "Unselected"){
						$friend['connection_start'] = "NA"; 
	                    $friend['on_acq'] = "Unselected";
	                    $friend['off_acq'] = "Unselected";
	                    $friend['off_oft'] = "Unselected"; 
					}

					if ($friend['other_sn'] != "NA" || $friend['other_sn_num'] != "NA" ){
	                    $friend['other_sn'] = "NA";
	                    $friend['other_sn_num'] = "NA"; 
	                }
				}
			}
			$json = json_encode($friends);
			$save_query = "UPDATE friends SET json='$json' WHERE user_name='$user' and batch='$batch'";
			//mysql_query($save_query) or die(mysql_error());
			header("Location: question1.php?batch=$action");
		}
	}

	//error_log($_POST['save']);

	

	exit;

?>