<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/assets/lib/html5.js"></script>
<script type="text/javascript" src="/assets/lib/respond.min.js"></script>
<script type="text/javascript" src="/assets/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/assets/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="/assets/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/assets/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/assets/js/H-ui.js"></script> 
<script type="text/javascript" src="/assets/js/admin.js" ></script>
<script type="text/javascript" src="/assets/js/commonmk.js" ></script>
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台登录 - 插队宝</title>
</head>
<body>
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <div class="form form-horizontal">
      <div class="row cl">
        <label class="form-label col-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-8">
          <input id="username" name="" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-8">
          <input id="password" name="" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-8 col-offset-3">
          <input id="verificationCode" class="input-text size-L" type="text" placeholder="验证码" style="width:150px;">
          <img id="verificationCodeImg" src="" style="height: 40px;vertical-align: top;"> <a id="kanbuq" href="javascript:refreshCode();">看不清，换一张</a> </div>
      </div>
    <!--   <div class="row">
        <div class="formControls col-8 col-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="">
            使我保持登录状态</label>
        </div>
      </div> -->
      <div class="row">
        <div class="formControls col-8 col-offset-3">
          <input onclick="adminLogin();" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="footer">Copyright NCUT</div>
<div id="waitDiv"><img src="/assets/images/cms/loading.gif"></div>
<div id="messageAlert" class="km-alert km-alert-dismissible fade in" style="width:40%;display:none;">
  <button type="button" class="km-close" onclick="$('#messageAlert').hide();"><span>×</span></button>
  <strong></strong>
  <span class="km-alert-msg"></span>
</div>
<div id="bkDiv"></div>
<script>
refreshCode();
</script>
</body>
</html>