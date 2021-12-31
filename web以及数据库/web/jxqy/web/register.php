<?php
	error_reporting(0);
	header("Content-Type:text/html; charset=utf-8");
if($_POST["op"] == "注册") {
	session_start();
	include("connect.php");
	$form = $_POST["edit"];
	$username = trim($form["name"]);
	$password = md5(trim($form["pass"]));
	$email = trim($form["email"]);
		
	$sql2 = "select  *  from users where account='{$username}'  limit 1 ";
	$res2 = mysql_query($sql2);
	$row = mysql_fetch_array($res2);
	if($row) {
		$alert = "<script>swal('已存在该用户名,请重试!');</script>";
	}else{
		$reg_time = date("Y-m-d H:i:s");
		$sql = "insert into users(account,password,email,reg_time) ";
		$sql .= " values('{$username}',";
		$sql .= " '{$password}',";
		$sql .= " '{$email}',";
		$sql .= " '{$reg_time}') ";	
		$res = mysql_query($sql);
		if(!$res) {
			die("数据库出错，请返回重试!");
		}else{
			$alert = "<script>swal('注册成功!','','success');</script>";
		}
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>注册</title>
	<link rel="stylesheet" href="css/weui.min.css" />
	<link rel="stylesheet" href="css/swiper.min.css" />
  	<link rel="stylesheet" href="css/wx.css" />
  	<link rel="stylesheet" href="css/sweetalert.css" />
	<script src="sweetalert.min.js"></script>
	<script src="jquery.js"></script>
	<script type="text/javascript">
		function CheckReg(){
			var user=$.trim($("#name").val());
			var username=/^[0-9a-zA-Z]*$/g;
			if(user.length==0){
				swal("用户名不能为空!");
				return false;
			}else if(!username.test(user)){
				swal("用户名只能是英文或数字!");
				return false;
			}			
			var password=$.trim($("#pass").val());
			if(password.length==0){
				swal("密码不可以为空!");
				return false;
			}			
			if(password == user){
				swal("密码不能跟账户相同!");
				return false;
			}
			var password2=$.trim($("#pass2").val());
			if(password2 != password){
				swal("两次输入的密码不一致!");
				return false;
			}
			var email=$.trim($("#email").val());
			if(email.length==0){
				swal("安全码不可以为空!");
				return false;
			}		
		}
	</script>
</head>
<body style="background-color: #FFF;">
	<header class="ui-header">  
		<h1 class="ui-title">注册</h1>
	</header>
	<div class="weui-content">
		<div class="weui-form">
			<form action="register.php"  method="post" onSubmit="return CheckReg()">
				<div class="form-body">
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="text" value="" placeholder="用户名" name="edit[name]" id="name">
						</div>
					</div>
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="password" value="" placeholder="输入密码" name="edit[pass]" id="pass">
						</div>
					</div>
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="password" value="" placeholder="再次输入密码" name="edit[pass2]" id="pass2">
						</div>
					</div>
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="text" value="" placeholder="安全码" name="edit[email]" id="email">
						</div>
					</div>
				</div>
				<div class="weui-cell-button">
					<input class="weui-btn weui-btn_primary weui-btn-submit" type="submit" name="op" value="注册" />
				</div>
			</form>
			<div class="weui-cell-footer">
				<label for="weuiAgree" class="weui-agree">
				</label>
				<div class="cell-links">
					<a href="retrieve.php">找回密码</a>
				</div>
			</div>
		</div>
	</div>
	<?php echo $alert; ?>
</body>
</html>
