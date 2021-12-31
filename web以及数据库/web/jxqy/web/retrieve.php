<?php
	error_reporting(0);
	header("Content-Type:text/html; charset=utf-8");
	if($_POST["op"] == "找回密码") {
		session_start();
		include("connect.php");
		$form = $_POST["edit"];
		$username = trim($form["name"]);
		$email = trim($form["email"]);
			
		$sql2 = "select * from users where account='{$username}'  limit 1 ";
		$res2 = mysql_query($sql2);
		$row = mysql_fetch_array($res2);
		if(!$row) {
			$alert = "<script>swal('不存在该用户名的,请重试!');</script>";
		}elseif($email != $row["email"]){
			$alert = "<script>swal('安全码错误,请重试!');</script>";
		}else{
			$_SESSION["username"] = $row["account"];
			$_SESSION["email"] = $email;
			header("location:reset.php");
			exit;
		}
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>找回密码</title>
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
		<h1 class="ui-title">找回密码</h1>
	</header>
	<div class="weui-content">
		<div class="weui-form">
			<form action="retrieve.php"  method="post" onSubmit="return CheckReg()">
				<div class="form-body">
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="text" value="" placeholder="用户名" name="edit[name]" id="name">
						</div>
					</div>
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="text" value="" placeholder="安全码" name="edit[email]" id="email">
						</div>
					</div>
				</div>
				<div class="weui-cell-button">
					<input class="weui-btn weui-btn_primary weui-btn-submit" type="submit" name="op" value="找回密码" />
				</div>
			</form>
			<div class="weui-cell-footer">
				<label for="weuiAgree" class="weui-agree">
				</label>
				<div class="cell-links">
					<a href="register.php">注册</a>
				</div>
			</div>
		</div>
	</div>
	<?php echo $alert; ?>
</body>
</html>
