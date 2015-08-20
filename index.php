<?php
	require("conn.php");
	$user_name = "sumonkywe";
	$sql = "SELECT * FROM `friends` WHERE `user_name` = '".$user_name."' AND `batch` = 1";
	print($sql);
	print("<br>");
	$sql_result = mysql_query($sql, $con);
	$row = mysql_fetch_array($sql_result);
	$batch = $row[1];
	$json_ori = $row[2];
	$json = $row[3];
	$labelled = $row[4];
	$numOfRelevantFriends = $row[5];
	echo $labelled;
	echo "</br>----</br>";
	echo $numOfRelevantFriends;
	echo "</br>----</br>";
	//echo $json_ori;

	var_dump(json_decode($json));
	//echo "</br>----</br>";
	//echo $json;
	//1 2 7 8-1 8-2 9
?>


