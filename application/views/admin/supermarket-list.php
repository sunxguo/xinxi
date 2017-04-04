<title>超市管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 卖家管理 <span class="c-gray en">&gt;</span> 超市管理 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c"> 注册时间：
		<input type="text" value="<?php echo isset($_GET['startTime'])?$_GET['startTime']:'';?>" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:'';?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
		类型：
		<select id="type" class="select" name="admin-role" size="1" style="height:31px;width:inherit;vertical-align:middle;">
			<option value="-1" <?php echo !isset($_GET['type'])?'selected':'';?>>所有</option>
			<option value="0" <?php echo isset($_GET['type']) && $_GET['type']=='0'?'selected':'';?>>总店</option>
			<option value="1" <?php echo isset($_GET['type']) && $_GET['type']=='1'?'selected':'';?>>分店</option>
		</select>
		<input type="text" value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:'';?>" id="keywords" class="input-text" style="width:250px" placeholder="输入超市名称/分店名称"name="">
		<button onclick="searchSuperMarket();" type="submit" class="btn btn-success radius" name=""><i class="Hui-iconfont">&#xe665;</i> 搜超市</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			<a href="javascript:;" onclick="member_add('添加超市总店','/admin/supermarketadd','','410')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加超市总店</a>
			<a href="javascript:;" onclick="member_add('添加超市分店','/admin/subsupermarketadd','','610')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加超市分店</a>
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="100">Logo</th>
				<th width="80">超市代码</th>
				<th width="80">超市编号</th>
				<th width="100">超市名</th>
				<th width="100">分店名</th>
				<th width="40">类型</th>
				<th width="60">省</th>
				<th width="60">市</th>
				<th width="60">区</th>
				<!-- <th width="150">二维码</th> -->
				<th width="150">详细地址</th>
				<th width="50">经度</th>
				<th width="50">纬度</th>
				<!-- <th width="40">是否默认</th> -->
				<th width="130">添加时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($superMarkets as $superMarket):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $superMarket->id;?>" name="id"></td>
				<td><img src="<?php echo $superMarket->logo;?>" width="100"></td>
				<td><?php echo $superMarket->no;?></td>
				<td><?php echo $superMarket->sno;?></td>
				<td><?php echo $superMarket->name;?></td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $superMarket->name.' - '.$superMarket->sname;?>','/admin/supermarketshow','<?php echo $superMarket->id;?>','360','440')"><?php echo $superMarket->sname;?></u></td>
				<td><?php echo $superMarket->type=='0'?'总店':'分店';?></td>
				<td><?php echo $superMarket->province;?></td>
				<td><?php echo $superMarket->city;?></td>
				<td><?php echo $superMarket->area;?></td>
				<td><?php echo $superMarket->detailedarea;?></td>
				<td><?php echo $superMarket->lng;?></td>
				<td><?php echo $superMarket->lat;?></td>
				<td><?php echo $superMarket->addtime;?></td>
				<?php if($superMarket->status=='0'):?>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-defaunt radius">已停用</span></td>
				<?php endif;?>
				<td class="td-manage">
					<?php if($superMarket->status=='0'):?>
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $superMarket->id;?>')" href="javascript:;" title="停用">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
					<?php else:?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $superMarket->id;?>')" href="javascript:;" title="启用">
						<i class="Hui-iconfont">&#xe6e1;</i>
					</a> 
					<?php endif;?>
					<?php if($superMarket->type=='0'):?>
					<a title="编辑" href="javascript:;" onclick="member_edit('修改超市信息','/admin/supermarketedit','<?php echo $superMarket->id;?>','','410')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<?php else:?>
					<a title="编辑" href="javascript:;" onclick="member_edit('修改超市信息','/admin/subsupermarketedit','<?php echo $superMarket->id;?>','','610')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<?php endif;?>
					<!-- <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','/admin/sellerchangepassword','<?php echo $superMarket->id;?>','600','270')" href="javascript:;" title="修改密码">
						<i class="Hui-iconfont">&#xe63f;</i>
					</a>  -->
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $superMarket->id;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<script type="text/javascript" src="/assets/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 13, "desc" ]],//默认第几个排序
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
			$('.table').$('tr.selected').removeClass('selected');
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
		var supermarket = new Object(); 
	    supermarket.infoType = 'supermarket';
	    supermarket.id = id;
	    supermarket.status = 1;
	    dataHandler('/common/modifyInfo',supermarket,null,null,null,function(){
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
		var supermarket = new Object(); 
	    supermarket.infoType = 'supermarket';
	    supermarket.id = id;
	    supermarket.status = 0;
	    dataHandler('/common/modifyInfo',supermarket,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var supermarket = new Object(); 
	    supermarket.infoType = 'supermarket';
	    supermarket.id = id;
		dataHandler('/common/deleteInfo',supermarket,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*seller-批量删除*/
function member_del_bulk(){
	var memberArray = new Array();
    $("input[name='id']:checked").each(function(){
        memberArray.push($(this).val()); 
    });
    if(memberArray.length<1){
       layer.alert('请选择要删除的超市！');
        return false;
    }
	layer.confirm('确认要删除这些超市吗？',function(index){
	    var supermarkets = new Object();
	    supermarkets.infoType = 'supermarkets';
	    supermarkets.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",supermarkets,null,null,null,function(){
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