<script charset="utf-8" src="/assets/js/jquery.form.js"></script>
<script type="text/javascript" src="/assets/lib/icheck/jquery.icheck.min.js"></script>
<link rel="stylesheet" href="/assets/kindEditor/themes/default/default.css" />
<script charset="utf-8" src="/assets/kindEditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/assets/kindEditor/lang/zh_CN.js"></script>

<title>新增图片</title>
</head>
<body>
<div class="pd-20">
	<div class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>Banner标题：</label>
			<div class="formControls col-10">
				<input type="text" class="input-text" value="" placeholder="" id="title" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">排序值：</label>
			<div class="formControls col-2">
				<input type="text" class="input-text" value="0" placeholder="" id="orderNumber" name="">从小到大排序
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">Banner内容：</label>
			<div class="formControls col-10">
				<textarea id="content" name="" cols="" rows="" class="textarea"></textarea>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>图片：</label>
			<div class="formControls col-10">
                <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">            
				<div class="uploader-thum-container">
					<div id="fileList" class="uploader-list">
                           
                    </div>
					<div id="filePicker" onclick="$('#file').click();" style="margin-top:10px;">
                        <div class="webuploader-pick">选择图片</div>
                    </div>
                    <form id="uploadImgThumb" enctype="multipart/form-data">
                        <input onchange="return uploadThumb()" name="image" type="file" id="file" style="display:none;" accept="image/*">
                    </form>
					<!-- <button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button> -->
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-2">
				<button onClick="saveBanner(true,false);" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并发布</button>
				<button onClick="saveBanner(true,true);" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
});

var contentEditor;
KindEditor.ready(function(K) {
    contentEditor = K.create('#content', {
        uploadJson : '/assets/kindEditor/php/upload_json.php',
        fileManagerJson : '/assets/kindEditor/php/file_manager_json.php',
        allowFileManager : true,
        width : '100%',
        height:'200px',
        resizeType:0,
        imageTabIndex:1
    });
});
</script>
</body>
</html>