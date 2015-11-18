<title>添加超市总店</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form action="?id=<?php echo $supermarket->id;?>" class="form form-horizontal" id="form-member-add">
    <input id="type" value="0" type="hidden">
    <input id="id" value="<?php echo $supermarket->id;?>" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市代码：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $supermarket->no;?>" placeholder="" id="no" name="no" datatype="*2-16" nullmsg="超市代码不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市编号：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $supermarket->sno;?>" placeholder="" id="sno" name="sno" datatype="*2-16" nullmsg="超市编号不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市名：</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -  -->
        <input type="text" class="input-text" value="<?php echo $supermarket->name;?>" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="超市名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">Logo：</label>
      <div class="formControls col-5">
        <img src="<?php echo $supermarket->logo;?>" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否启用：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" <?php echo $supermarket->status=='0'?'checked':'';?>>
          <label for="status-1">立即启用</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1" <?php echo $supermarket->status=='1'?'checked':'';?>>
          <label for="status-2">暂不启用</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<form id="uploadImgThumb" enctype="multipart/form-data">
    <input onchange="return uploadThumb()" name="image" type="file" id="file" style="display:none;" accept="image/*">
</form>
<script type="text/javascript" src="/assets/lib/icheck/jquery.icheck.min.js"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").Validform({
		tiptype:2,
		callback:function(form){
      // alert('ok');
			// form[0].submit();
      saveSuperMarket(false,function(){
        alert('保存成功！');
        var index = parent.layer.getFrameIndex(window.name);
        // parent.$('.btn-refresh').click();
        parent.window.location.reload();
        parent.layer.close(index);
      });
		}
	});
});
</script>
</body>
</html>