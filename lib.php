<?php

	function get_batch_num($user){
		require("conn.php");
		$sql = "SELECT count(*) FROM `friends` WHERE `user_name` = '$user'";
		$sql_result = mysql_query($sql, $con);
		$result = mysql_fetch_array($sql_result);
		return $result[0];		
	}

	function get_json($user, $batch){
		require("conn.php");
		$sql = "SELECT `json` FROM `friends` WHERE `user_name` = '".$user."' AND `batch` = ".$batch." LIMIT 1";
		$sql_result = mysql_query($sql, $con);
		$row = mysql_fetch_array($sql_result);
		
		return json_decode($row[0], true);
	}
?>