<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 用户列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c"> 注册时间：
		<input type="text" value="<?php echo isset($_GET['startTime'])?$_GET['startTime']:'';?>" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:'';?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
		 性别：
		<select id="gender" class="select" name="admin-role" size="1" style="height:31px;width:inherit;vertical-align:middle;">
			<option value="-1" <?php echo !isset($_GET['gender'])?'selected':'';?>>所有</option>
			<option value="0" <?php echo isset($_GET['gender']) && $_GET['gender']=='0'?'selected':'';?>>男</option>
			<option value="1" <?php echo isset($_GET['gender']) && $_GET['gender']=='1'?'selected':'';?>>女</option>
			<option value="NULL" <?php echo isset($_GET['gender']) && $_GET['gender']=='NULL'?'selected':'';?>>未知</option>
		</select>
		<input type="text" value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:'';?>" id="keywords" class="input-text" style="width:250px" placeholder="输入用户昵称、手机"name="">
		<button onclick="searchBuyer();" type="submit" class="btn btn-success radius" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			<!-- <a href="javascript:;" onclick="member_add('添加用户','/admin/member-add.html','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a> -->
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">插队码</th>
				<th width="100">昵称</th>
				<th width="40">性别</th>
				<th width="90">手机</th>
				<!-- <th width="150">二维码</th> -->
				<th width="150">头像</th>
				<th width="80">生日</th>
				<th width="60">设备类型</th>
				<th width="130">注册时间</th>
				<th width="130">默认选择超市</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($buyers as $buyer):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $buyer->id;?>" name="id"></td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $buyer->alias;?>','/admin/buyershow','<?php echo $buyer->id;?>','360','440')"><?php echo $buyer->linecode;?></u></td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $buyer->alias;?>','/admin/buyershow','<?php echo $buyer->id;?>','360','440')"><?php echo $buyer->alias;?></u></td>
				<td><?php echo $buyer->gender=='0'?'男':($buyer->gender=='1'?'女':'未知');?></td>
				<td><?php echo $buyer->phone;?></td>
				<!-- <td><img src="<?php echo $buyer->qrcode;?>"></td> -->
				<td><img src="<?php echo $buyer->photo;?>"></td><!-- <td class="text-l">北京市 海淀区</td> -->
				<td><?php echo $buyer->birthdate;?></td>
				<td><?php echo $buyer->devicetype=='0'?'Android':($buyer->devicetype=='1'?'IOS':'未知');?></td>
				<td><?php echo $buyer->addtime;?></td>
				<td><?php echo isset($buyer->supermarket->name)?$buyer->supermarket->name.'-'.$buyer->supermarket->sname:'无';?></td>
				<?php if($buyer->status=='0'):?>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-defaunt radius">已停用</span></td>
				<?php endif;?>
				<td class="td-manage">
					<?php if($buyer->status=='0'):?>
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $buyer->id;?>')" href="javascript:;" title="停用">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
					<?php else:?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $buyer->id;?>')" href="javascript:;" title="启用">
						<i class="Hui-iconfont">&#xe6e1;</i>
					</a> 
					<?php endif;?>
					<!-- <a title="编辑" href="javascript:;" onclick="member_edit('修改用户信息','/admin/member-add.html','4','','510')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','/admin/changepassword','<?php echo $buyer->id;?>','600','270')" href="javascript:;" title="修改密码">
						<i class="Hui-iconfont">&#xe63f;</i>
					</a>  -->
					<!-- <a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $buyer->id;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a> -->
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 8, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});
	$('.table-sort tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
});
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		var buyer = new Object(); 
	    buyer.infoType = 'buyer';
	    buyer.id = id;
	    buyer.status = 1;
	    dataHandler('/common/modifyInfo',buyer,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
			$(obj).remove();
			layer.msg('已停用!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var buyer = new Object(); 
	    buyer.infoType = 'buyer';
	    buyer.id = id;
	    buyer.status = 0;
	    dataHandler('/common/modifyInfo',buyer,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var buyer = new Object(); 
	    buyer.infoType = 'buyer';
	    buyer.id = id;
		dataHandler('/common/deleteInfo',buyer,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*buyer-批量删除*/
function member_del_bulk(){
	var memberArray = new Array();
    $("input[name='id']:checked").each(function(){
        memberArray.push($(this).val()); 
    });
    if(memberArray.length<1){
       layer.alert('请选择要删除的用户！');
        return false;
    }
	layer.confirm('确认要删除这些用户吗？',function(index){
	    var buyers = new Object();
	    buyers.infoType = 'buyers';
	    buyers.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",buyers,null,null,null,function(){
	    	$("input[name='id']:checked").each(function(){
		        $(this).parents("tr").remove();
		    });
			layer.msg('已删除!',{icon:1,time:1000});
	    },false,false);
	});
}
</script> 
</body>
</html>