<title>图片列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> Banner管理 <span class="c-gray en">&gt;</span> Banner列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c"> 日期范围：
		<input type="text" value="<?php echo isset($_GET['startTime'])?$_GET['startTime']:'';?>" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:'';?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:'';?>" id="keywords" placeholder=" Banner 标题" style="width:250px" class="input-text">
		<button onclick="searchBanner();" name="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜Banner</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="picture_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="picture_add('添加Banner','/admin/banneradd')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加Banner</a></span> <span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="40"><input name="" type="checkbox" value=""></th>
					<th width="100">封面</th>
					<th>Banner标题</th>
					<th width="150">添加时间</th>
					<th width="150">最后更新时间</th>
					<th width="60">草稿</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($banners as $banner):?>
				<tr class="text-c">
					<td><input name="id" type="checkbox" value="<?php echo $banner->id;?>"></td>
					<td>
						<a href="javascript:;" onClick="picture_edit('编辑Banner','/admin/banneredit','<?php echo $banner->id;?>')">
							<img width="100" class="picture-thumb" src="<?php echo $banner->thumbnail;?>">
						</a>
					</td>
					<td class="text-l">
						<a class="maincolor" href="javascript:;" onClick="picture_edit('编辑Banner','/admin/banneredit','<?php echo $banner->id;?>')"><?php echo $banner->title;?></a>
					</td>
					<td><?php echo $banner->addtime;?></td>
					<td><?php echo $banner->edittime;?></td>
					<td class="td-status">
						<?php if($banner->draft):?>
						<span class="label label-defaunt radius">草稿</span>
						<?php else:?>	
						<span class="label label-success radius">已发布</span>
						<?php endif;?>
					</td>
					<td class="td-manage">
						<?php if($banner->draft):?>
						<a style="text-decoration:none" onClick="picture_start(this,'<?php echo $banner->id;?>')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a> 
						<?php else:?>
						<a style="text-decoration:none" onClick="picture_stop(this,'<?php echo $banner->id;?>')" href="javascript:;" title="存草稿"><i class="Hui-iconfont">&#xe6de;</i></a> 
						<?php endif;?>
						<a style="text-decoration:none" class="ml-5" onClick="picture_edit('编辑Banner','/admin/banneredit','<?php echo $banner->id;?>')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
						<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'<?php echo $banner->id;?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 4, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
	]
});
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-查看*/
function picture_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-审核*/
function picture_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'], 
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*图片-下架*/
function picture_stop(obj,id){
	layer.confirm('确认要存为草稿吗？',function(index){
		var banner = new Object(); 
	    banner.infoType = 'banner';
	    banner.id = id;
	    banner.draft = 1;
	    dataHandler('/common/modifyInfo',banner,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_start(this,'+id+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">草稿</span>');
			$(obj).remove();
			layer.msg('已存为草稿!',{icon: 5,time:1000});
		},false,false);
	});
}

/*图片-发布*/
function picture_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		var banner = new Object(); 
	    banner.infoType = 'banner';
	    banner.id = id;
	    banner.draft = 0;
		dataHandler('/common/modifyInfo',banner,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_stop(this,'+id+')" href="javascript:;" title="存为草稿"><i class="Hui-iconfont">&#xe6de;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
			$(obj).remove();
			layer.msg('已发布!',{icon: 6,time:1000});
		},false,false);
		
	});
}
/*图片-申请上线*/
function picture_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
/*图片-编辑*/
function picture_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url+'?id='+id
	});
	layer.full(index);
}
/*图片-删除*/
function picture_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var banner = new Object(); 
	    banner.infoType = 'banner';
	    banner.id = id;
		dataHandler('/common/deleteInfo',banner,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*图片-批量删除*/
function picture_del_bulk(){
	var bannerArray = new Array();
    $("input[name='id']:checked").each(function(){
        bannerArray.push($(this).val()); 
    });
    if(bannerArray.length<1){
       layer.alert('请选择要删除的Banner！');
        return false;
    }
	layer.confirm('确认要删除这些Banner吗？',function(index){
	    var banners = new Object();
	    banners.infoType = 'banners';
	    banners.idArray = bannerArray;
	    dataHandler("/common/deleteBulkInfo",banners,null,null,null,function(){
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