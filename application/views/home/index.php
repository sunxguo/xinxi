<!DOCTYPE html>
<html>
<head>
	<!-- <meta name="viewport" content="width=device-width,initial-scale=1"/> -->
	<title>插队宝-下载</title>
	<style type="text/css">
	*{
		margin: 0px;
	}
	.clearfix {
		*zoom: 1;
	}
	.clearfix:before,
	.clearfix:after { 
		display: table; 
		line-height: 0; 
		content: ""; 
	} 
	.clearfix:after { 
		clear: both;
	} 
	.head,
	.body .download,
	.body .privilege,
	.foot{
		max-width: 1000px;
		margin: 0 auto;
	}
	.body .delivery{
		width: 100%;
		background: rgb(238,238,238);
		margin-top: 40px;
		padding-top: 40px;
		padding-bottom: 40px;
	}
	.head{
		margin-top: 10px;
		margin-bottom: 5px;
	}
	.head img{
		max-width: 100%;
	}
	.body{
		width: 100%;

	}
	.body .background{
		position: relative;
	}
	.body .background .background-image{
		position:absolute;
		z-index:-1;
		width:100%;
		min-height: 503px;
		/*opacity:0.9;
		filter:alpha(opacity=90); /* 针对 IE8 以及更早的版本 */
	}
	.body .introduction{
		width: 100%;
	}
	.body .introduction .introduction-left{
		width: 50%;
		float: left;
		text-align: right;
	}
	.body .introduction .introduction-right{
		width: 50%;
		float: left;
		text-align: left;
	}
	.body .introduction .introduction-left img{
		height: 150px;
	    margin-top: 240px;
	    margin-right: 50px;
	}
	.body .introduction .introduction-right img{
		height: 400px;
   		margin-top: 103px;
	}
	.body .download{
		padding-bottom: 20px;
		border-bottom: dashed 1px #CCC;
	}
	.body .download .apple{
		width: 50%;
		float: left;
	}
	.body .download .android{
		width: 50%;
		float: left;
	}
	.body .download .download-title{
		height: 60px;
		text-align: center;
		font-family:Microsoft Yahei;
		font-size:  20px;
		font-weight: normal;
		margin-top: 30px;
		color: rgb(51,51,51);
	}
	.body .download a{
		background: rgb(51,51,51);
		width: 150px;
		height: 50px;
		display: inline-block;
		border-radius: 5px;
		line-height: 50px;
		color: white;
		text-decoration: none;
		font-family:Microsoft Yahei;
		font-size:  18px;
	}
	.body .download .apple .download-main a:nth-child(1),
	.body .download .android .download-main a:nth-child(1){
		float: left;
		margin-left: 85px;
	}
	.body .download .apple .download-main a:nth-child(2),
	.body .download .android .download-main a:nth-child(2){
		float: right;
		margin-right: 85px;
	}
	.body .download a img{
		width: 16px;
		vertical-align: middle;
		margin-left:15px;
		margin-right:10px;
		margin-bottom: 5px;
	}
	.body .privilege h3,
	.body .delivery h3{
		height: 60px;
		text-align: center;
		font-family:Microsoft Yahei;
		font-size:  20px;
		font-weight: normal;
		margin-top: 50px;
		color: rgb(51,51,51);
	}
	.body .privilege p,
	.body .delivery p{
		text-align: center;
		font-family:Microsoft Yahei;
		font-size:  16px;
		font-weight: normal;
		color: rgb(51,51,51);
		margin-top: -20px;
	}
	.body .privilege .items{
		margin-left: 85px;
	}
	.body .privilege .items li{
		float: left;
		list-style: none;
		margin-left: 100px;
		text-align: center;
		margin-top: 30px;
	}
	.body .privilege .items li img{
		display: block;
		margin-left: 30px;
	}
	.body .privilege .items li p{
		background: rgb(51,51,51);
		width: 120px;
		height: 30px;
		display: inline-block;
		border-radius: 3px;
		line-height: 30px;
		color: white;
		text-decoration: none;
		font-family:Microsoft Yahei;
		font-size:  14px;
		margin-top: 20px;
	}
	.body .delivery .progress{
		width: 473px;
		margin: 50px auto;
	}
	.foot{
		text-align: center;
		font-family:Microsoft Yahei;
		font-size:  14px;
		line-height: 40px;
	}
	</style>
</head>
<body style="overflow-x:hidden;">
	<div class="head">
		<img src="/assets/images/home/cdb-top.png">
	</div>
	<div class="body">
		<div class="background">
    		<img class="background-image" src="/assets/images/home/background.png" width="100%" height="100%" />
			<div class="introduction">
				<div class="introduction-left">
					<img src="/assets/images/home/cdb-summary.png">
				</div>
				<div class="introduction-right">
					<img src="/assets/images/home/cdb-phone.png">
				</div>
			</div>
		</div>
		<div class="download clearfix">
			<div class="apple">
				<h3 class="download-title">
					IOS用户下载
				</h3>
				<div class="download-main">
					<a href="#">
						<img src="/assets/images/home/apple.png">买家版下载
					</a>
					<a href="#">
						<img src="/assets/images/home/apple.png">卖家版下载
					</a>
				</div>
			</div>
			<div class="android">
				<h3 class="download-title">
					Android用户下载
				</h3>
				<div class="download-main">
					<a href="#">
						<img src="/assets/images/home/android.png">买家版下载
					</a>
					<a href="#">
						<img src="/assets/images/home/android.png">卖家版下载
					</a>
				</div>
			</div>
		</div>
		<div class="privilege clearfix">
			<h3>App专享优惠</h3>
			<p>超市购物，不用等，走在实践的前面……</p>
			<ul class="items">
				<li>
					<img src="/assets/images/home/coupon.png" style="margin-top:12px;">
					<p>App专享优惠券</p>
				</li>
				<li>
					<img src="/assets/images/home/pig.png">
					<p>打折促销</p>
				</li>
				<li>
					<img src="/assets/images/home/money.png" style="margin-top:9px;">
					<p>满减活动</p>
				</li>
			</ul>
		</div>
		<div class="delivery">
			<h3>随时随地查物流</h3>
			<p>超市特派，专员送货，自提、送货上门随你选……</p>
			<div class="progress">
				<img src="/assets/images/home/cdb-bottom.png">
			</div>
		</div>
	</div>
	<div class="foot">
		插队宝版权所有 2004-2014 ICP证：辽B2-20120045
	</div>
</body>
</html>
