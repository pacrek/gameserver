<?php
	error_reporting(0);
	header("Content-Type:text/html; charset=utf-8");
	session_start();
	include("connect.php");
	$username = trim($_GET["account"]);
	$password = trim($_GET["password"]);
	if(!$username || !$password) {
		echo 'LoginFail';
		exit;
	}
	$sql = "select  *  from users where account='{$username}'  limit 1 ";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if(!$row) {
		echo 'NoAccount';
		exit;
	}elseif(md5($password) != $row["password"]) {
		echo 'LoginFail';
		exit;
	}elseif($row["ban"]==1){
	    echo 'Accountban';
		exit;
	}
	
	   echo 'LoginOK';
	   exit;

?>
