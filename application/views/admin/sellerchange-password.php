<title>修改密码</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
	<form method="post" class="form form-horizontal" id="form-change-password">
		<input id="id" value="<?php echo $seller->id;?>" type="hidden">
		<div class="row cl">
			<label class="form-label col-4"><span class="c-red">*</span>账户：</label>
			<div class="formControls col-4"> <?php echo $seller->name;?> </div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-4"><span class="c-red">*</span>新密码：</label>
			<div class="formControls col-4">
				<input type="password" class="input-text" autocomplete="off" name="new-password" id="new-password" datatype="*6-18" nullmsg="请输入新密码！" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-4"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-4">
				<input type="password" class="input-text" autocomplete="off" name="new-password2" id="new-password2" recheck="new-password" datatype="*6-18" errormsg="您两次输入的密码不一致！" nullmsg="请确认新密码！" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<div class="col-8 col-offset-4">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="/assets/lib/icheck/jquery.icheck.min.js"></script>
<script>
$(function(){
	$("#form-change-password").Validform({
		tiptype:2,
		callback:function(form){
			// form[0].submit();
			saveSellerPassword(function(){
				alert('修改成功！');
				var index = parent.layer.getFrameIndex(window.name);
				parent.layer.close(index);
      		});
		}
	});
});
</script>
</body>
</html>