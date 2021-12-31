<?php
	$dbhost = "localhost";
	$dbname = "info";
	$dbuser = "root";
	$dbpass = "123456";
	$con = mysql_connect($dbhost,$dbuser,$dbpass);
	if(!$con) die("mysql error:".mysql_error());
	mysql_select_db($dbname,$con);
	mysql_query('SET NAMES utf8');
?>