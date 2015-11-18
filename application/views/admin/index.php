<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<title>插队宝后台管理系统</title>
</head>
<body>
<header class="Hui-header cl"> <a class="Hui-logo l" title="H-ui.admin v2.3" href="#">插队宝后台管理系统</a> <a class="Hui-logo-m l" href="#" title="H-ui.admin"></a> <span class="Hui-subtitle l">Beta</span>
	<nav class="mainnav cl" id="Hui-nav">
		<ul>
			<li class="dropDown dropDown_click"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
				<ul class="dropDown-menu radius box-shadow">
					<li><a href="javascript:;" onclick="picture_add('添加Banner','/admin/banneradd')"><i class="Hui-iconfont">&#xe613;</i> Banner</a></li>
					<li><a href="javascript:;" onclick="product_add('添加商品','/admin/productadd')"><i class="Hui-iconfont">&#xe620;</i> 商品</a></li>
					<li><a href="javascript:;" onclick="member_add('添加超市','/admin/supermarketadd','','510')"><i class="Hui-iconfont">&#xe60d;</i> 超市</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<ul class="Hui-userbar">
		<li>超级管理员</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo $_SESSION['username'];?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="#">个人信息</a></li>
				<li><a href="#">切换账户</a></li>
				<li><a href="/admin/login">退出</a></li>
			</ul>
		</li>
		<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
		<li id="Hui-skin" class="dropDown right dropDown_hover"><a href="javascript:;" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
				<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
				<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
				<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
				<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
				<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
			</ul>
		</li>
	</ul>
	<a aria-hidden="false" class="Hui-nav-toggle" href="#"></a> </header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> Banner管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/bannerlist" href="javascript:void(0)">Banner管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 用户管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/buyerlist" href="javascript:;">用户列表</a></li>
					<!-- <li><a _href="member-del.html" href="javascript:;">删除的会员</a></li>
					<li><a _href="member-level.html" href="javascript:;">等级管理</a></li>
					<li><a _href="member-scoreoperation.html" href="javascript:;">积分管理</a></li>
					<li><a _href="member-record-browse.html" href="javascript:void(0)">浏览记录</a></li>
					<li><a _href="member-record-download.html" href="javascript:void(0)">下载记录</a></li>
					<li><a _href="member-record-share.html" href="javascript:void(0)">分享记录</a></li> -->
				</ul>
			</dd>
		</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/productlist" href="javascript:void(0)">商品管理</a></li>
					<!-- <li><a _href="/admin/productbrand" href="javascript:void(0)">品牌管理</a></li> -->
					<li><a _href="/admin/categorylist" href="javascript:void(0)">分类管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 卖家管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/supermarketlist" href="javascript:void(0)">超市管理</a></li>
					<li><a _href="/admin/sellermarketlist" href="javascript:void(0)">超市账号管理</a></li>
					<li><a _href="/admin/sellerdeliverylist" href="javascript:void(0)">物流账号管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe687;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/orderlist" href="javascript:void(0)">订单管理</a></li>
					<li><a _href="/admin/deliverylist" href="javascript:void(0)">物流管理</a></li>
					<li><a _href="/admin/commentlist" href="javascript:void(0)">评价管理</a></li>
				</ul>
			</dd>
		</dl>
		<!--<dl id="menu-page">
			<dt><i class="Hui-iconfont">&#xe626;</i> 页面管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="page-home.html" href="javascript:void(0)">首页管理</a></li>
					<li><a _href="page-flinks.html" href="javascript:void(0)">友情链接</a></li>
				</ul>
			</dd>
		</dl>-->
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe6ca;</i> 优惠券管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/coupon" href="javascript:;">优惠券管理</a></li>
					<!-- <li><a _href="feedback-list.html" href="javascript:void(0)">意见反馈</a></li> -->
				</ul>
			</dd>
		</dl>
		<!--<dl id="menu-order">
			<dt><i class="Hui-iconfont">&#xe63a;</i> 财务管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="order-list.html" href="javascript:void(0)">订单列表</a></li>
					<li><a _href="recharge-list.html" href="javascript:void(0)">充值管理</a></li>
					<li><a _href="invoice-list.html" href="javascript:void(0)">发票管理</a></li>
				</ul>
			</dd>
		</dl>-->
		<!-- <dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="admin-role.html" href="javascript:void(0)">角色管理</a></li>
					<li><a _href="admin-permission.html" href="javascript:void(0)">权限管理</a></li>
					<li><a _href="admin-list.html" href="javascript:void(0)">管理员列表</a></li>
				</ul>
			</dd>
		</dl> -->
		<!-- <dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="charts-1.html" href="javascript:void(0)">折线图</a></li>
					<li><a _href="charts-2.html" href="javascript:void(0)">时间轴折线图</a></li>
					<li><a _href="charts-3.html" href="javascript:void(0)">区域图</a></li>
					<li><a _href="charts-4.html" href="javascript:void(0)">柱状图</a></li>
					<li><a _href="charts-5.html" href="javascript:void(0)">饼状图</a></li>
					<li><a _href="charts-6.html" href="javascript:void(0)">3D柱状图</a></li>
					<li><a _href="charts-7.html" href="javascript:void(0)">3D饼状图</a></li>
				</ul>
			</dd>
		</dl> -->
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<!-- <li><a _href="system-base.html" href="javascript:void(0)">系统设置</a></li>
					<li><a _href="system-category.html" href="javascript:void(0)">栏目管理</a></li>
					<li><a _href="system-data.html" href="javascript:void(0)">数据字典</a></li>
					<li><a _href="system-shielding.html" href="javascript:void(0)">屏蔽词</a></li>
					<li><a _href="system-log.html" href="javascript:void(0)">系统日志</a></li> -->
					<li><a _href="system-base.html" href="javascript:void(0)">关于我们</a></li>
					<li><a _href="system-base.html" href="javascript:void(0)">意见反馈</a></li>
					<li><a _href="system-base.html" href="javascript:void(0)">推送消息</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" data-href="/admin/welcome">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="/admin/welcome"></iframe>
		</div>
	</div>
</section>
<script type="text/javascript">
/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
</script>
</body>
</html>