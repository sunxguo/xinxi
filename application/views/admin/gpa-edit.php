<title>编辑</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <div class="form form-horizontal" id="form-member-add">
    <input id="id" value="<?php echo $gpa->id;?>" type="hidden">
    <input id="studentId" value="<?php echo $student->id;?>" type="hidden">
    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="supermarket" onchange="getCategories();" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择所属总超市！">
          <option value="" selected>请选择超市</option>
          <?php foreach($supermarkets as $sm):?>
          <optgroup label="<?php echo $sm->name;?>">
            <?php foreach($sm->subSupermarkets as $ssm):?>
            <option value="<?php echo $ssm->id;?>" <?php echo $ssm->id==$product->sid?'selected':'';?>><?php echo $ssm->sname;?></option>
            <?php endforeach;?>
          </optgroup>
          
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div> -->
    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="category" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择商品分类！">
          <?php foreach($categories as $category):?>
          <option value="<?php echo $category->id;?>" <?php echo $category->id==$product->categoryid?'selected':'';?>><?php echo $category->name;?></option>
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>学院：</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -  -->
        <!-- <input type="text" class="input-text" value="<?php echo $speciality->academy;?>" placeholder="" id="academy" name="academy" datatype="*2-16" nullmsg="学院名称不能为空"> -->
        <span><?php echo $academy->name;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>班级：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $class->name;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>学号：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $student->number;?>" placeholder="" id="studentNumber" name="studentNumber" datatype="*2-16" nullmsg="学号不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>姓名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $student->name;?>" placeholder="" id="studentName" name="studentName" datatype="*2-16" nullmsg="姓名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>性别：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="gender-1" name="gender" value="0" datatype="*" <?php echo $student->gender=='0'?'checked':'';?>>
          <label for="gender-1">男</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="gender-2" name="gender" value="1" <?php echo $student->gender=='1'?'checked':'';?>>
          <label for="gender-2">女</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>专业：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $speciality->name;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>学制：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $speciality->length;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>地区：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $student->address;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>民族：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $student->nation;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>性质：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $student->property;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>课程编码：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $course->code;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>课程名称：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $course->name;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>合班：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $score->bigclass;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>平时成绩：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $score->score_ordinary;?>" placeholder="" id="score_ordinary" name="score_ordinary" datatype="*1-6" ignore="ignore" nullmsg="平时成绩不能为空">
        <!-- <span><?php echo $score->score_ordinary;?></span> -->
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>期末成绩：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $score->score_term;?>" placeholder="" id="score_term" name="score_term" datatype="*1-6" ignore="ignore" nullmsg="期末成绩不能为空">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <!-- <span><?php echo $score->score_term;?></span> -->
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>总评：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $score->score;?>" placeholder="" id="score" name="score" datatype="*1-6" ignore="ignore" nullmsg="总评不能为空">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <!-- <span><?php echo $score->score;?></span> -->
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>考试性质：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $score->examproperty;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>学期：</label>
      <div class="formControls col-5">
        <!-- <input type="text" class="input-text" value="<?php echo $class->name;?>" placeholder="" id="className" name="className" datatype="*2-16" ignore="ignore" nullmsg="班级不能为空"> -->
        <span><?php echo $semester->name;?></span>
      </div>
      <div class="col-4"> </div>
    </div>
    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片：</label>
      <div class="formControls col-5">
        <img src="<?php echo $product->photo;?>" id="thumbnail" style="max-width:90%;max-height:100px;">
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
          <input type="radio" id="isedit-1" name="isedit" value="0" datatype="*" <?php echo $product->isedit=='0'?'checked':'';?>>
          <label for="isedit-1">否</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="isedit-2" name="isedit" value="1" <?php echo $product->isedit=='1'?'checked':'';?>>
          <label for="isedit-2">是</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否上架：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" <?php echo $product->status=='0'?'checked':'';?>>
          <label for="status-1">立即上架</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1" <?php echo $product->status=='1'?'checked':'';?>>
          <label for="status-2">暂不上架</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <button onClick="saveScore(false);" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存 </button>
        <button onClick="layer_close();" class="btn btn-default radius" type="button"><i class="Hui-iconfont">&#xe60b;</i> 取消 </button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- <form id="uploadImgThumb" enctype="multipart/form-data">
    <input onchange="return uploadThumb()" name="image" type="file" id="file" style="display:none;" accept="image/*">
</form> -->
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
      saveProduct(false,function(){
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