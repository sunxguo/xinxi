<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/cms.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/template.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-theme.css" type="text/css"/>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
	<script src="/assets/js/common.js" type="text/javascript"></script>
	<script src="/assets/js/cms.js" type="text/javascript"></script>
	<script src="/assets/js/admin.js" type="text/javascript"></script>
	<script src="/assets/js/jquery.form.js" type="text/javascript"></script>
</head>
<body>
    <div class="header-cms">
		<a  class="km-logo" href="">
            <img src="/assets/img/logo.png" alt="<?php echo $websiteName;?>" class="logo-asm"/>
		</a>
        <ul class="menu-cms">
            <li class="name">
                <img id="userPhoto" src="/assets/images/cms/defaulthead.png" width="35" height="35">
				<span id="userShowName"><?php echo $_SESSION['username'];?></span>
			</li>
			<li class="message">
				<a href="/cms/message" title="Messages" id="js-openmsg">
					<img src="/assets/images/cms/ico_mail.png" width="24" height="24">
					<span class="message-num">0</span>
				</a>
				<span id="unreadMesNumber"></span>
			</li>
			<li class="logout">
				<a href="/adminajax/logout" title="退出">退出</a>
			</li>
        </ul>
    </div>
	<div class="cms-main">
	<?php
		if(isset($showSider) && $showSider){
			require("sider.php");
		}
	?>
	<div id="msgBox" class="msg-box">
		<a href="javascript:closeMsg()" class="close" title="Close">Close</a>
		<div class="msg-in">
			<ul>
				<li>
					<a href="#" id="newMsg">Message-content</a>
					<span class="messagetime" id="msgTime">2015-2-13 19:00</span>
				</li>
			</ul>
		</div>
	</div>