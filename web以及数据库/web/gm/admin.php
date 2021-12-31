
<!DOCTYPE html>
<html lang="CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>[www.523play.com]剑侠情缘后台</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">			
    </head>
    <body>
        <div class="top-content">        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>[www.523play.com]剑侠情缘GM在线后台</h3>
                            		<p>管理员权限<br> 
                        		</div>
                        		<div class="form-top-right">
                        			<i><img src='assets/img/backgrounds/user.jpg'></i>
                        		</div>
                            </div>
                            <div class="form-bottom">

			                    	<div class="form-group">
			                        	<select name="name" class="form-username form-control" id="form-qu">
										<option value="10001">1区</option>
                                        <option value="10002">2区</option> 
                                        <option value="10004">3区</option>
                                        <option value="10007">4区</option>
                                        <option value="10008">5区</option>
                                        <option value="10009">6区</option>
										</select>
			                        </div>		
                                        <div class="form-group">
			                        	<input type="password" name="name" placeholder="GMpassword..." class="form-username form-control" id="form-gmpass">
			                        </div>									
			                    	<div class="form-group">
			                        	<//input type="number" name="name" placeholder="角色ID" class="form-username form-control" id="form-username">
										<input type="text" name="name" placeholder="角色名/角色ID" class="form-username form-control" id="form-username">
			                        </div>									
									<button type="submit" class="btn" id="enfeng">封 号</button><br><br>
									<button type="submit" class="btn" id="defeng">解 封</button><br><br>
									<button type="submit" class="btn" id="delbag">背 包 清 理</button><br><br>
									<input type="text" name="gg" placeholder="公告内容..." class="form-username form-control" id="form-gg"><br>
									<button type="submit" class="btn" id="note">发 送 系 统 公 告</button><br><br>
			                    	<div class="form-group">
			                    	
			                        	<input type="text" name="money" placeholder="输入数量 元宝/黎饰/经验/VIP经验..." class="form-username form-control" id="form-money">
			                        </div>									
									<button type="submit" class="btn" id="mail1">元 宝 充 值</button><br><br>
									<button type="submit" class="btn" id="mail3">黎 饰 充 值</button><br><br>	
									<button type="submit" class="btn" id="mail4">经 验 发 送</button><br><br>
                                    <button type="submit" class="btn" id="VipExp">VIP经 验 发 送</button><br><br>
			                        <div class="form-group">
									<input type="text" name="money" placeholder="物品搜索..." class="form-username form-control" id="form-searchipt">
									<button type="submit" class="btn" id="search">搜 索</button>									
										<select id='form-itemid' class="form-password form-control">
											<?php
												$file = file_get_contents("item.txt");
												$file_path2 = fopen("item.txt","r+");
												fwrite($file_path2,$file);
												fclose($file_path2);											
												$file = fopen("item.txt", "r");
												while(!feof($file))
												{
												$line=fgets($file);
												$txts=explode(';',$line);
												$txts = preg_replace('# #','',$txts);
												echo '<option value="'.$txts[0].'">'.$txts[1].'</option>';
												}
												fclose($file);
											?>
										</select><br>								
			                        
			                        	<input type="text" name="num" placeholder="物品数量..." class="form-username form-control" id="form-num">
			                        </div>									
										<button type="submit" class="btn" id="mail2">发 送</button>
									<br><br>
										<button type="submit" class="btn" id="all">全 服 发 送</button>
										
									</div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
		<script src="./layer/jquery-1.7.2.min.js"></script>
		<script src="./layer/layergm.js?mason001"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
  
</html>