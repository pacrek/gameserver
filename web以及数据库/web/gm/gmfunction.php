<?php
//error_reporting(0);
header("Content-type: text/html; charset=utf8");
if (isset($_POST)){
	@$gm = $_POST['gm'];
	@$account = $_POST['name'];
	@$money = $_POST['money'];	
	@$itemid = $_POST['itemid'];
	@$num = 	$_POST['num'];
	@$note = $_POST['gg'];
	@$qu = 	$_POST['qu'];
	$url = 'http://127.0.0.1:8088/efunsendreward';
	$gg = '123456';//file_get_contents($curl.'gm.txt');
	if($gm == ""){
		$return = array('code'=>0,'info'=>'GM密码不可为空!!!');
		exit(json_encode($return));
	}
	if($qu == ""){
		$return = array('code'=>0,'info'=>'请选择分区!!!');
		exit(json_encode($return));
	}	
	if($gm != $gg){
		$return = array('code'=>0,'info'=>'GM密码错误!!!');
		exit(json_encode($return));
	}
  	if($account == false && $_POST['type'] != ('note' || 'all')){
		$return = array('code'=>0,'info'=>'角色名/角色ID不能为空!!!');
		exit(json_encode($return));
    }
	function get($url,$postdata){
		$return = json_decode(file_get_contents($url.'?'.http_build_query($postdata)),true);
		if($return['code']=='1000'){
			return '成功';
		}else{
			return ' 失败 '.@$return['message'].@$return['msg'];
		}
	}
  
  	$quid = array(
    		10001=>'ft_branch_CatNine',
            10002=>'ft_branch_CatNine2',
            10004=>'ft_branch_CatNine4',
            10007=>'ft_branch_CatNine7',
            10008=>'ft_branch_CatNine8',
            10009=>'ft_branch_CatNine9',
    	);
         @$link = mysql_connect('127.0.0.1','root','123456')or die(json_encode(array('code'=>81,'info'=>'连接服务器失败')));
	@mysql_select_db($quid[$qu]);
	@mysql_query("set names utf8");
	if (preg_match("/^\+?[1-9][0-9]*$/",$account)){
         @$sql = "select * from `Player` where `ID`='{$account}'";
  	@$row = mysql_fetch_array(mysql_query($sql));
         @$tbname = $row['PlayerName'];
            if($tbname == false){
		$return = array('code'=>0,'info'=>'角色不存在!!!');
		exit(json_encode($return));
	  }

                  $roleid = $account;
       	}else{
	@$sql = "select * from `Player` where `PlayerName`='{$account}'";
  	@$row = mysql_fetch_array(mysql_query($sql));
         @$roleid = $row['ID'];
	}
  	
	$time = time();	
	$type = $_POST['type'];
	switch 	($type){
		case 'all':
				if ($itemid == "" || $itemid == '0') {
					$return = array('code'=>0,'info'=>'请选择物品');
					exit(json_encode($return));
				}
				if ($num == "") {
					$return = array('code'=>0,'info'=>'物品数量不能为空');
					exit(json_encode($return));
				}
				$data=array(
								'userId'=>4,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>time(),
								'packageId'=>'item,'.$itemid.','.$num.'',
								'title'=>'全服邮件',
								'content'=>'本资源由“吾爱尚玩资源基地”测试发布！更多资源请访问：WWW.523PLAY.COM',
								//'md5Str'=>'5ABF11E40D465ADADC2022F64C1E73FF',
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'发送:'.$result);
				exit(json_encode($return));				
				break;
		case 'mail1':
				if($roleid == false){
				$return = array('code'=>0,'info'=>'角色不存在!!!');
				exit(json_encode($return));
				}		
				if ($money == "") {
					$return = array('code'=>0,'info'=>'元宝数量不能为空!!!');
					exit(json_encode($return));
				}
				$vipexp = $money/10;
				$data=array(
								'userId'=>1,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>time(),
								'packageId'=>"Gold,{$money}",
								'title'=>'情缘剑侠的邮件',
								'content'=>'本资源由“吾爱尚玩资源基地”测试发布！更多资源请访问：WWW.523PLAY.COM',
								//'md5Str'=>'5ABF11E40D465ADADC2022F64C1E73FF',
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'充值:'.$result);
				exit(json_encode($return));
				break;
		case 'mail2':	
				if($roleid == false){
				$return = array('code'=>0,'info'=>'角色不存在!!!');
				exit(json_encode($return));
				}
				if ($itemid == "" || $itemid == '0') {
					$return = array('code'=>0,'info'=>'请选择物品');
					exit(json_encode($return));
				}
				if ($num == "") {
					$return = array('code'=>0,'info'=>'物品数量不能为空');
					exit(json_encode($return));
				}
				$data=array(
								'userId'=>1,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>time(),
								'packageId'=>'item,'.$itemid.','.$num.'',
								'title'=>'情缘剑侠的邮件',
								'content'=>'本资源由“吾爱尚玩资源基地”测试发布！更多资源请访问：WWW.523PLAY.COM',
								//'md5Str'=>'5ABF11E40D465ADADC2022F64C1E73FF',
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'发送:'.$result);
				exit(json_encode($return));
				break;
		case 'mail3':
				if($roleid == false){
				$return = array('code'=>0,'info'=>'角色不存在!!!');
				exit(json_encode($return));
				}		
				if ($money == "") {
					$return = array('code'=>0,'info'=>'黎饰数量不能为空!!!');
					exit(json_encode($return));
				}	
				$data=array(
								'userId'=>1,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>time(),
								'packageId'=>'SilverBoard,'.$money,
								'title'=>'情缘剑侠的邮件',
								'content'=>'本资源由“吾爱尚玩资源基地”测试发布！更多资源请访问：WWW.523PLAY.COM',
								//'md5Str'=>'5ABF11E40D465ADADC2022F64C1E73FF',
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'充值:'.$result);
				exit(json_encode($return));
				break;		
		case 'mail4':
				if($roleid == false){
				$return = array('code'=>0,'info'=>'角色不存在!!!');
				exit(json_encode($return));
				}		
				if ($money == "") {
					$return = array('code'=>0,'info'=>'经验数量不能为空!!!');
					exit(json_encode($return));
				}	
				$data=array(
								'userId'=>1,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>time(),
								'packageId'=>'Exp,'.$money,
								'title'=>'情缘剑侠的邮件',
								'content'=>'本资源由“吾爱尚玩资源基地”测试发布！更多资源请访问：WWW.523PLAY.COM',
								//'md5Str'=>'5ABF11E40D465ADADC2022F64C1E73FF',
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'充值:'.$result);
				exit(json_encode($return));
				break;
       case 'VipExp':
				if($roleid == false){
				$return = array('code'=>0,'info'=>'角色不存在!!!');
				exit(json_encode($return));
				}		
				if ($money == "") {
					$return = array('code'=>0,'info'=>'VIP经验数量不能为空!!!');
					exit(json_encode($return));
				}	
				$data=array(
								'userId'=>1,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>time(),
								'packageId'=>'VipExp,'.$money,
								'title'=>'情缘剑侠的邮件',
								'content'=>'本资源由“吾爱尚玩资源基地”测试发布！更多资源请访问：WWW.523PLAY.COM',
								//'md5Str'=>'5ABF11E40D465ADADC2022F64C1E73FF',
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'充值:'.$result);
				exit(json_encode($return));
				break;
		case 'enfeng':
				if($roleid == false){
				$return = array('code'=>0,'info'=>'角色不存在!!!');
				exit(json_encode($return));
				}
				if($roleid == ""){
					$return = array('code'=>0,'info'=>'角色ID不能为空!!!');
					exit(json_encode($return));
				}			
				$data=array(
								'userId'=>2,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>enfeng,
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'封号:'.$result);
				exit(json_encode($return));
				break;	
		case 'defeng':
				if($roleid == false){
				$return = array('code'=>0,'info'=>'角色不存在!!!');
				exit(json_encode($return));
				}
				if($roleid == ""){
					$return = array('code'=>0,'info'=>'角色ID不能为空!!!');
					exit(json_encode($return));
				}			
				$data=array(
								'userId'=>3,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>defeng,
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'解封:'.$result);
				exit(json_encode($return));
				break;	
		case 'delbag':
				if($roleid == ""){
					$return = array('code'=>0,'info'=>'角色ID不能为空!!!');
					exit(json_encode($return));
				}			
				$data=array(
								'userId'=>6,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>cleanbag,
							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'清理背包:'.$result);
				exit(json_encode($return));
				break;				
		case 'note':
				if($note == ""){
					$return = array('code'=>0,'info'=>'公告不能为空!!!');
					exit(json_encode($return));
				}		
				$data=array(
								'userId'=>5,
								'roleId'=>$roleid,
								'serverCode'=>$qu,
								'serialNo'=>note,
                                                                       'content'=>$note,							);
				$result=get($url,$data);
				$return = array('code'=>0,'info'=>'发送公告:'.$result);
				exit(json_encode($return));
				break;
		default:
				$return = array('code'=>0,'info'=>'type错误'.$type);
				exit(json_encode($return));
	}
}	
?>