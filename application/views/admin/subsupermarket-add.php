<title>添加超市分店</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市总店：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="supermarket" onchange="setSupermarketLogo();" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择所属总超市！">
          <option value="" selected>请选择超市</option>
          <?php foreach($supermarkets as $sm):?>
          <option value="<?php echo $sm->id;?>"><?php echo $sm->name;?></option>
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <!-- <div class="row cl">
      <label class="form-label col-3"></label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="subsupermarket" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择所属具体超市！">
          <option value="" selected>请选择具体超市</option>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市编号：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="sno" name="sno" datatype="*2-16" nullmsg="超市编号不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分店名：</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -  -->
        <input type="text" class="input-text" value="" placeholder="" id="sname" name="sname" datatype="*2-16" nullmsg="分店名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">Logo：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>性别：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="sex-1" name="gender" value="0" datatype="*" nullmsg="请选择性别！">
          <label for="sex-1">男</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-2" name="gender" value="1">
          <label for="sex-2">女</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-3" name="gender" value="2">
          <label for="sex-3">保密</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>省：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="province"  datatype="*" nullmsg="‘省’不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>市：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="city"  datatype="*" nullmsg="‘市’不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>区：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="area"  datatype="*" nullmsg="‘区’不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>详细地址：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="detailedarea"  datatype="*" nullmsg="‘详细地址’不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">经度：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="lng"  datatype="*" ignore="ignore">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">纬度：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="lat"  datatype="*" ignore="ignore">
      </div>
      <div class="col-4"> </div>
    </div>
    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>密码：</label>
      <div class="formControls col-5">
        <input type="password" class="input-text" placeholder="" name="password" id="password" datatype="*6-16" nullmsg="请输入密码！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">头像：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <!-- <div class="row cl">
      <label class="form-label col-3">备注：</label>
      <div class="formControls col-5">
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否启用：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" checked="checked">
          <label for="status-1">立即启用</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1">
          <label for="status-2">暂不启用</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">
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
      saveSubSuperMarket(true,function(){
        alert('添加成功！');
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