<?php
	error_reporting(0);
	header("Content-Type:text/html; charset=utf-8");
	if($_POST["op"] == "登录") {
		session_start();
		include("connect.php");
		$form = $_POST["edit"];
		$username = trim($form["name"]);
		$password = trim($form["pass"]);
		$sql = "select * from admin where account='{$username}' limit 1 ";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		if(md5($password) != $row["password"]) {
			$alert = "<script>swal('用户名或密码有误,请重试!','','warning');</script>";
		}else{
			$_SESSION["userid"] = $row["id"];
			$_SESSION["uname"] = $username;	
			$alert = "<script>alert('登录成功!');window.location.href='index.php'</script>";
			//$log_time = date("Y-m-d H:i:s");
			//$sql2 = "update users set log_time = '{$log_time}' where account = '{$username}' ";
			//$res2 = mysql_query($sql2);
		}
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>登录</title>
	<link rel="stylesheet" href="css/weui.min.css" />
	<link rel="stylesheet" href="css/swiper.min.css" />
  	<link rel="stylesheet" href="css/wx.css" />
  	<link rel="stylesheet" href="css/sweetalert.css" />
	<script src="sweetalert.min.js"></script>
	<script src="jquery.js"></script>
</head>
<body style="background-color: #FFF;">
	<div class="weui-form">
		<div class="form-logo">
			<img src="/images/logo.png" />
		</div>
		<form action="login.php"  method="post">
			<div class="form-body">
				<div class="weui-cell">
					<div class="weui-cell__bd">
						<input class="weui-input" type="text" value="" placeholder="用户名" id="login_phone" name="edit[name]">
					</div>
				</div>
				<div class="weui-cell">
					<div class="weui-cell__bd">
						<input class="weui-input" type="password" value="" placeholder="密码" id="login_pwd" name="edit[pass]">
					</div>
				</div>
			</div>
			<div class="weui-cell-button">
				<input class="weui-btn weui-btn_primary weui-btn-submit" type="submit" name="op" value="登录" />
			</div>
		</form>
		<div class="weui-cell-footer">
			<label for="weuiAgree" class="weui-agree">
			</label>
			<div class="cell-links">
				<a href="retrieve.php">找回密码</a><span> | </span><a href="register.php">注册账户</a>
			</div>
		</div>
  </div>
  <?php echo $alert; ?>
</body>
</html>