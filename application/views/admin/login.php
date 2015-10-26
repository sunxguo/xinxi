<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <title><?php echo $title;?></title>
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/admin.css" type="text/css"/>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
	<script src="/assets/js/admin.js" type="text/javascript"></script>
	<script src="/assets/js/common.js" type="text/javascript"></script>
</head>

<body class="bk">
	<div class="login_main">
		<form class="form-login">
			<input type="text" id="username" placeholder="Username"/><br/>
			<i class="icon icon-user"></i>
			<input type="password" id="password" placeholder="Password"/><br/>
			<i class="icon icon-lock"></i>
			<!--	
			<div class="login-field">
				<div class="veri-code">
					<img id="validCodeImg" src="" onclick="refreshCode()" style="float: left;">
                    <a href="javascript:refreshCode()">Refresh</a>
                    <input name="securitycode" type="text" placeholder="Security Code" style="width:50%;text-indent: 1em;  float: right;">
				</div>
			</div>
			-->
			<input onclick="adminLogin();" type="button" value="Login"  class="btn btn-blue form-control"/>
		</form>
	</div>
<script>
	refreshCode();
</script>
</body>
</html>