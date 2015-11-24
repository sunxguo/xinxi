<title>订单管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c">
		  超市：
		<select id="supermarket" class="select" style="height:31px;width:inherit;vertical-align:middle;">
          <option value="-1">所有</option>
          <?php foreach($supermarkets as $sm):?>
          <optgroup label="<?php echo $sm->name;?>">
            <?php foreach($sm->subSupermarkets as $ssm):?>
            <option value="<?php echo $ssm->id;?>" <?php echo isset($_GET['sid']) && $_GET['sid']==$ssm->id?'selected':'';?>><?php echo $ssm->sname;?></option>
            <?php endforeach;?>
          </optgroup>
          <?php endforeach;?>
        </select>
         下单时间：
		<input type="text" value="<?php echo isset($_GET['startTime'])?$_GET['startTime']:'';?>" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:'';?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
		<!-- 类型：
		<select id="type" class="select" name="admin-role" size="1" style="height:31px;width:inherit;vertical-align:middle;">
			<option value="-1" <?php echo !isset($_GET['type'])?'selected':'';?>>所有</option>
			<option value="0" <?php echo isset($_GET['type']) && $_GET['type']=='0'?'selected':'';?>>总店</option>
			<option value="1" <?php echo isset($_GET['type']) && $_GET['type']=='1'?'selected':'';?>>分店</option>
		</select> -->
		<input type="text" value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:'';?>" id="keywords" class="input-text" style="width:250px" placeholder="输入订单号"name="">
		<button onclick="searchOrder();" type="submit" class="btn btn-success radius" name=""><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			<!-- <a href="javascript:;" onclick="member_add('添加商品','/admin/productadd','','550')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加商品</a> -->
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">订单号</th>
				<th width="30">商品</th>
				<th width="80">超市</th>
				<th width="50">卖家账号</th>
				<th width="50">买家账号</th>
				<!-- <th width="100">收货地址</th> -->
				<!-- <th width="30">总件数</th> -->
				<!-- <th width="30">配送方式</th>
				<th width="100">配送时间</th> -->
				<th width="30">配送费</th>
				<th width="30">优惠价</th>
				<!-- <th width="50">优惠券</th> -->
				<th width="30">商品总价</th>
				<!-- <th width="30">总价</th> -->
				<th width="30">实际支付</th>
				<!-- <th width="30">支付方式</th> -->
				<!-- <th width="30">分享</th> -->
				<!-- <th width="30">买家删除</th>
				<th width="30">卖家删除</th>
				<th width="30">物流删除</th> -->
				<th width="80">下单时间</th>
				<th width="30">状态</th>
				<th width="20">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($orders as $order):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $order->id;?>" name="id"></td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $order->orderno;?>','/admin/ordershow','<?php echo $order->orderno;?>','360','440')"><?php echo $order->orderno;?></u></td>
				<td>
					<?php foreach($order->details as $detail):?>
					<img src="<?php echo $detail->product->photo;?>" title="<?php echo $detail->product->name;?>" alt="<?php echo $detail->product->name;?>" width="30"> × <?php echo $detail->count;?>
					<?php endforeach;?>
				</td>
				<td><?php echo $order->supermarket->name.' - '.$order->supermarket->sname;?></td>
				<td>
					<?php if(isset($order->seller->name)):?>
					<u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $order->seller->name;?>','/admin/sellershow','<?php echo $order->sellerid;?>','360','440')"><?php echo $order->seller->name;?></u>
					<?php elseif(isset($order->seller->workno)):?>
					<u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $order->seller->workno;?>','/admin/sellershow','<?php echo $order->sellerid;?>','360','440')"><?php echo $order->seller->workno;?></u>
					<?php else:?>
					账号不存在
					<?php endif;?>
				</td>
				<td>
					<?php if(isset($order->buyer->alias)):?>
					<u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $order->buyer->alias;?>','/admin/buyershow','<?php echo $order->buyerid;?>','360','440')"><?php echo $order->buyer->alias;?></u>
					<?php elseif(isset($order->buyer->linecode)):?>
					<u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $order->buyer->linecode;?>','/admin/buyershow','<?php echo $order->buyerid;?>','360','440')"><?php echo $order->buyer->linecode;?></u>
					<?php else:?>
					账号不存在
					<?php endif;?>
				</td>
				<!-- <td><?php echo $order->addressid;//echo $order->address->province.$order->address->city.$order->address->area.$order->address->detailarea.'<br>'.$order->address->name.' 电话：'.$order->address->phone;?></td> -->
				<!-- <td><?php echo $order->count;?></td> -->
				<!-- <td><?php echo $order->expressway=='0'?'物流':'自提';?></td>
				<td><?php echo $order->expresstime;?></td> -->
				<td><?php echo '￥'.$order->expressfee;?></td>
				<td><?php echo '￥'.$order->discount;?></td>
				<!-- <td><?php echo $order->couponid;?></td> -->
				<td><?php echo '￥'.$order->goodsprice;?></td>
				<!-- <td><?php echo $order->totalprice;?></td> -->
				<td><?php echo '￥'.$order->actualpay;?></td>
				<!-- <td><?php echo $order->paymentmethod=='0'?'支付宝':'微信';?></td> -->
				<!-- <td><?php echo $order->isshared=='0'?'否':'是';?></td>
				<td><?php echo $order->buyerdel=='0'?'否':'是';?></td>
				<td><?php echo $order->sellerdel=='0'?'否':'是';?></td>
				<td><?php echo $order->deliverydel=='0'?'否':'是';?></td> -->
				<td><?php echo $order->addtime;?></td>
				<!-- <td><u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo $product->name;?>','/admin/productshow','<?php echo $product->id;?>','360','380')"><?php echo $product->name;?></u></td> -->
				
				<?php if($order->status=='0'):?>
				<td class="td-status"><span class="label label-danger radius"><?php echo $order->status_zn?></span></td>
				<?php elseif($order->status=='1'):?>
				<td class="td-status"><span class="label label-primary radius"><?php echo $order->status_zn?></span></td>
				<?php elseif($order->status=='2'):?>
				<td class="td-status"><span class="label label-secondary radius"><?php echo $order->status_zn?></span></td>
				<?php elseif($order->status=='3'):?>
				<td class="td-status"><span class="label label-secondary radius"><?php echo $order->status_zn?></span></td>
				<?php elseif($order->status=='4'):?>
				<td class="td-status"><span class="label label-warning radius"><?php echo $order->status_zn?></span></td>
				<?php elseif($order->status=='5'):?>
				<td class="td-status"><span class="label label-success radius"><?php echo $order->status_zn?></span></td>
				<?php elseif($order->status=='6'):?>
				<td class="td-status"><span class="label label-success radius"><?php echo $order->status_zn?></span></td>
				<?php elseif($order->status=='-1'):?>
				<td class="td-status"><span class="label label-error radius"><?php echo $order->status_zn?></span></td>
				<?php else:?>
				<td class="td-status"><?php echo $order->status_zn?></td>
				<?php endif;?>
				<td class="td-manage">
					<?php /* if($product->status=='0'):?>
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $product->id;?>')" href="javascript:;" title="下架">
						<i class="Hui-iconfont">&#xe6de;</i>
					</a> 
					<?php else:?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $product->id;?>')" href="javascript:;" title="上架">
						<i class="Hui-iconfont">&#xe603;</i>
					</a> 
					<?php endif;?>
					<a title="编辑" href="javascript:;" onclick="member_edit('修改商品信息','/admin/productedit','<?php echo $product->id;?>','','550')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> */?>
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $order->id;?>')" class="ml-5" style="text-decoration:none">
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
		"aaSorting": [[ 10, "desc" ]],//默认第几个排序
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
	layer.confirm('确认要下架吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'product';
	    product.id = id;
	    product.status = 1;
	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe603;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
			$(obj).remove();
			layer.msg('已下架!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'product';
	    product.id = id;
	    product.status = 0;
	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
			$(obj).remove();
			layer.msg('已上架!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*图片-编辑*/
function product_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var order = new Object(); 
	    order.infoType = 'order';
	    order.id = id;
		dataHandler('/common/deleteInfo',order,null,null,null,function(){
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
       layer.alert('请选择要删除的订单！');
        return false;
    }
	layer.confirm('确认要删除这些订单吗？',function(index){
	    var orders = new Object();
	    orders.infoType = 'orders';
	    orders.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",orders,null,null,null,function(){
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