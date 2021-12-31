	var gm='';
	var name='';
	var money='';
	var itemid='';
	var num='';	
	var qu='';
	var gg='';
  $('#form-gmpass').change(function(){
	  gm=$.trim($(this).val());
  });
  $('#form-gg').change(function(){
	  gg=$.trim($(this).val());
  });  
  $('#form-username').change(function(){
	  name=$.trim($(this).val());
  });  
  $('#form-money').change(function(){
	  money=$.trim($(this).val());
  });
  $('#form-num').change(function(){
	  num=$.trim($(this).val());
  });   
  $('#mail1').click(function(){
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }
	  if(name==''){
		  alert('角色ID不能为空！');
		  return false;
	  }	  
	  if(money==''){
		  alert('元宝数量不能为空！');
		  return false;
	  }	
	qu=$('#form-qu').val();	  
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'mail1',name:name,money:money,gm:gm,qu:qu},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  });
  $('#mail2').click(function(){	
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }  
	  if(name==''){
		  alert('请填写角色名或角色ID！');
		  return false;
	  }
	  num=$('#form-num').val();
	  if(num==''){
		  alert('物品数量不能为空！');
		  return false;
	  }	 
		itemid=$('#form-itemid').val();$('#form-num').val();qu=$('#form-qu').val();
	  $.ajax({
		  url:'gmfunction.php',
		  type:'post',
		  'data':{type:'mail2',name:name,itemid:itemid,num:num,gm:gm,qu:qu},
          'cache':false,
          'dataType':'json',
		  success:function(data){
				  console.log('data',data);
				  alert(data.info);
			  },
		  error:function(){
			  alert('提交失败');
		  }
	  });
  }); 
  $('#mail3').click(function(){
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }
	  if(name==''){
		  alert('请填写角色名或角色ID！');
		  return false;
	  }	  
	  if(money==''){
		  alert('黎饰数量不能为空！');
		  return false;
	  }	 
	  qu=$('#form-qu').val();
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'mail3',name:name,money:money,gm:gm,qu:qu},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  }); 
  $('#mail4').click(function(){
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }
	  if(name==''){
		  alert('请填写角色名或角色ID！');
		  return false;
	  }	  
	  if(money==''){
		  alert('经验数量不能为空！');
		  return false;
	  }	 
	  qu=$('#form-qu').val();
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'mail4',name:name,money:money,gm:gm,qu:qu},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  });
   
     $('#VipExp').click(function(){//vip经验 by Mason
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }
	  if(name==''){
		  alert('请填写角色名或角色ID！');
		  return false;
	  }	  
	  if(money==''){
		  alert('VIP经验数量不能为空！');
		  return false;
	  }	 
	  qu=$('#form-qu').val();
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'VipExp',name:name,money:money,gm:gm,qu:qu},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  });  
  
  $('#search').click(function(){
	  var keyword=$('#form-searchipt').val();
	  $.ajax({
		  url:'itemquery.php',
		  type:'post',
		  'data':{keyword:keyword},
          'cache':false,
          'dataType':'json',
		  success:function(data){
			  if(data){
				  $('#form-itemid').html('');
				for (var i in data){
				 $('#form-itemid').append('<option value="'+data[i].key+'">'+data[i].val+'</option>');
				}
			  }else{
				  $('#form-itemid').html('<option value="0">未找到</option>');
			  }
		  },
		  error:function(){
			  alert('操作失败');
		  }
	  });
  });   
  $('#all').click(function(){	
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }  
	  num=$('#form-num').val();
	  if(num==''){
		  alert('物品数量不能为空！');
		  return false;
	  }	 
		itemid=$('#form-itemid').val();num=$('#form-num').val();qu=$('#form-qu').val();name=$('#form-username').val();
	  $.ajax({
		  url:'gmfunction.php',
		  type:'post',
		  'data':{type:'all',itemid:itemid,num:num,gm:gm,qu:qu,name:name},
          'cache':false,
          'dataType':'json',
		  success:function(data){
				  console.log('data',data);
				  alert(data.info);
			  },
		  error:function(){
			  alert('提交失败');
		  }
	  });
  });   
  $('#enfeng').click(function(){
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }
	  if(name==''){
		  alert('请填写角色名或角色ID！');
		  return false;
	  }	  
	qu=$('#form-qu').val();	  
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'enfeng',name:name,gm:gm,qu:qu},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  }); 
  $('#defeng').click(function(){
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }
	  if(name==''){
		  alert('请填写角色名或角色ID！');
		  return false;
	  }	  
	qu=$('#form-qu').val();	  
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'defeng',name:name,gm:gm,qu:qu},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  }); 
  $('#delbag').click(function(){
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }
	  if(name==''){
		  alert('请填写角色名或角色ID！');
		  return false;
	  }	  
	qu=$('#form-qu').val();	name=$('#form-username').val();  
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'delbag',name:name,gm:gm,qu:qu},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  });   
  $('#note').click(function(){
	  if(gm==''){
		  alert('GM密码不能为空！');
		  return false;
	  }  
	qu=$('#form-qu').val();	  gg=$('#form-gg').val();name=$('#form-username').val();	
	  if(gg==''){
		  alert('公告内容不能为空！');
		  return false;
	  }	
	$.ajax({
	url:'gmfunction.php',
	type:'POST',
	'data':{type:'note',gm:gm,qu:qu,gg:gg,name:name},
	'dataType':'json',
	success:function(data){
		console.log('data',data);
		alert(data.info);
	},
	error:function(){
	alert('提交失败');
	}
	});
  });   