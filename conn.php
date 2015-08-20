<?php
$con = @mysql_connect("localhost", "root", "");
if (!$con) {
	die("connect database false" . mysql_error());
}
mysql_select_db("twittertest", $con);
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET NAMES utf8");
?>