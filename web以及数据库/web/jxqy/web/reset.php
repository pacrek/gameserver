<?php
	error_reporting(0);
	header("Content-Type:text/html; charset=utf-8");
	session_start();
	if(!isset($_SESSION['email']) || !isset($_SESSION['username'])){
		header("location:retrieve.php");
	}			
	if($_POST["op"] == "重置密码") {
		session_start();
		include("connect.php");
		$form = $_POST["edit"];
		$password = md5(trim($form["pass"]));
		$username = $_SESSION["username"];
		$email = $_SESSION["email"];

		if($username == $password){
			$alert = "<script>swal('密码不能跟账户相同!');</script>";
		}else{
			$sql2 = "select * from users where account='{$username}'  limit 1 ";
			$res2 = mysql_query($sql2);
			$row = mysql_fetch_array($res2);
			if(!$row) {
				$alert = "<script>swal('不存在该用户名的,请重试!');</script>";
			}else{
				$emailDb = $row["email"];
				if($email != $emailDb){
					$alert = "<script>swal('安全码错误!');</script>";
				}else{
					$sql = "update users set password = '{$password}' where account = '{$username}' ";
					$res = mysql_query($sql);
					if(!$res) {
						die("数据库出错，请返回重试!");
					}	
					$_SESSION["email"] = '';
					$_SESSION["username"]='';
					$alert = "<script>swal('重置密码成功!','重置成功,请返回游戏登录','success');</script>";
				}
			}
		}
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>重置密码</title>
	<link rel="stylesheet" href="css/weui.min.css" />
	<link rel="stylesheet" href="css/swiper.min.css" />
  	<link rel="stylesheet" href="css/wx.css" />
  	<link rel="stylesheet" href="css/sweetalert.css" />
	<script src="sweetalert.min.js"></script>
	<script src="jquery.js"></script>
	<script type="text/javascript">
		function CheckReg(){
			var password=$.trim($("#pass").val());
			if(password.length==0){
				swal("密码不可以为空!");
				return false;
			}		
			var password2=$.trim($("#pass2").val());
			if(password2 != password){
				swal("两次输入的密码不一致!");
				return false;
			}	
		}
	</script>
</head>
<body style="background-color: #FFF;">
	<header class="ui-header">  
		<h1 class="ui-title">重置密码</h1>
	</header>
	<div class="weui-content">
		<div class="weui-form">
			<form action="reset.php"  method="post" onSubmit="return CheckReg()">
				<div class="form-body">
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
				</div>
				<div class="weui-cell-button">
					<input class="weui-btn weui-btn_primary weui-btn-submit" type="submit" name="op" value="重置密码" />
				</div>
			</form>
			<div class="weui-cell-footer">
				<label for="weuiAgree" class="weui-agree">
				</label>
				<div class="cell-links">
				</div>
			</div>
		</div>
	</div>
	<?php echo $alert; ?>
</body>
</html>