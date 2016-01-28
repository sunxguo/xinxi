<title>添加商品</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="supermarket" onchange="getCategories();" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择所属总超市！">
          <option value="" selected>请选择超市</option>
          <?php foreach($supermarkets as $sm):?>
          <optgroup label="<?php echo $sm->name;?>">
            <?php foreach($sm->subSupermarkets as $ssm):?>
            <option value="<?php echo $ssm->id;?>"><?php echo $ssm->sname;?></option>
            <?php endforeach;?>
          </optgroup>
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="category" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择商品分类！">
          <option value="" selected>请选择分类</option>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品名称：</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -  -->
        <input type="text" class="input-text" value="" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="商品名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">条形码：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="barcode" name="barcode" datatype="*2-16" ignore="ignore">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>价格：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="price" name="price" datatype="*2-16" nullmsg="价格不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否可编辑：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="isedit-1" name="isedit" value="0" datatype="*" checked="checked">
          <label for="isedit-1">否</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="isedit-2" name="isedit" value="1">
          <label for="isedit-2">是</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否上架：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" checked="checked">
          <label for="status-1">立即上架</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1">
          <label for="status-2">暂不上架</label>
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
      saveProduct(true,function(){
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