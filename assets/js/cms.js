$(document).ready(function(){
	$(".nav-header").click(function(){
		$(this).next('ul').slideToggle();
	});
	//$(".footer").offset().top   $("body").height()
	$(".panel-sidebar").css("min-height",$(".footer").offset().top);
});
function column(handleType,nameNullMsg,successMsg){
	if($("#name").val()==""){
		alert(nameNullMsg);
		return false;
	}
	if($("#name").val()=="") $("#name").val("50");
	var column = new Object(); 
	column.fid = $("#fatherlevel").val();
	column.name = $("#name").val();
	column.display = $('input[name="display"]:checked').val();
	column.type = $("#type").val();
	column.order_num = $('#orderNum').val();
	if(handleType=="modify") column.id = $("#column_id").val();
	dataHandler(handleType,"column",column,null,null,null,successMsg,true);
}
function delColumn(currentId,confirmMsg,successMsg){
	showWait();
	var column = new Object(); 
	column.id = currentId;
	dataHandler("del","column",column,null,confirmMsg,closeWait(),successMsg,true);
}
function selectEssay(baseUrl){
	var extUrl="";
	if($("#state").val()!=-1) extUrl+="&state="+$("#state").val();
	if($("#column").val()!=0) extUrl+="&column="+$("#column").val();
	if($("#keyword").val()!="") extUrl+="&search="+$("#keyword").val();
	location.href=baseUrl+extUrl;
}
function uploadContentThumb(){
	uploadImage(addThumbBeforeUpload,addThumbAfterUpload);
}
function addThumbBeforeUpload(){
	$("#addImgList div img").attr("src","/assets/images/cms/loading.gif");
}
function addThumbAfterUpload(imageSrc){
	$("#addImgList div img").attr("src","/assets/images/cms/appbg_ad.png");
	var new_img_item='<li onmouseover="imgover(this)" onmouseout="imgout(this)" class="img-item imagelist"><img class="thumb-src" width="77" height="77" src="'+imageSrc+'"><img onclick="delclick(this)" class="del-bt" title="删除该缩略图" src="/assets/images/cms/delete.png"></li>';
	$("#addImgList").before(new_img_item);
	if($("#imgListDivs").children(".imagelist").length>=3){
		$("#addImgList").hide();
	}
}
function imgout(obj){
	$(obj).find('.del-bt').hide();
}
function imgover(obj){
	$(obj).find('.del-bt').show();
}
function delclick(obj){
	$(obj).parent('.imagelist').remove();
	$("#file").val("");
	$("#addImgList").show();
}
function essayHandler(draft,successMsg,newEssay){
	if($("#column").val()==-1){
		alert("请选择发布到的栏目！");
		return false;
	}
	if($("#title").val()==""){
		alert("请输入文章标题！");
		return false;
	}
/*	if($("#imgListDivs .imagelist").length<1){
		alert("请上传至少一张缩略图！");
		return false;
	}*/
	var essay = new Object();
	essay.column_id = $("#column").val();
	essay.title = $("#title").val();
	essay.summary = $("#summary").val();
	essay.content = textEditor.html();
	essay.thumbnail = getThumb("#imgListDivs .imagelist");
	essay.draft = draft;
	var handlerType='';
	if(newEssay){
		handlerType='add';
	}else{
		essay.id = $("#essayId").val();
		handlerType='modify';
	}
	dataHandler(handlerType,'essay',essay,null,null,null,successMsg,true);
}
function modifyShopImg(position,imageSrc){
	var shopImg = new Object();
	shopImg.position = position;
	shopImg.image = imageSrc;
	dataHandler('modify','shopImg',shopImg,null,null,null,'Success',false);
}
function uploadShopTopImage(){
	uploadImageAdvance('#upload_top_image_form',addShopTopImageBeforeUpload,addShopTopImageAfterUpload);
}
function addShopTopImageBeforeUpload(){
	$("#shopTopImage").attr("src","/assets/images/cms/loading.gif");
}
function addShopTopImageAfterUpload(imageSrc){
	$("#shopTopImage").attr("src",imageSrc);
	modifyShopImg('top',imageSrc);
}
function deleteShopTopImage(){
	if(confirm('Sure to delete shop banner and save?')){
		modifyShopImg('top','');
	}
	$("#shopTopImage").attr('src','');
}
function deleteShopMiddleImage(){
	if(confirm('Sure to delete shop main advertisement and save?')){
		modifyShopImg('middle','');
	}
	$("#shopMiddleImage").attr('src','');
}
function deleteShopBottomImage(){
	if(confirm('Sure to delete shop secondary advertisement and save?')){
		modifyShopImg('bottom','');
	}
	$("#shopBottomImage").attr('src','');
}
function uploadShopMiddleImage(){
	uploadImageAdvance('#upload_middle_image_form',addShopMiddleImageBeforeUpload,addShopMiddleImageAfterUpload);
}
function addShopMiddleImageBeforeUpload(){
	$("#shopMiddleImage").attr("src","/assets/images/cms/loading.gif");
}
function addShopMiddleImageAfterUpload(imageSrc){
	$("#shopMiddleImage").attr("src",imageSrc);
	modifyShopImg('middle',imageSrc);
}
function uploadShopBottomImage(){
	uploadImageAdvance('#upload_bottom_image_form',addShopBottomImageBeforeUpload,addShopBottomImageAfterUpload);
}
function addShopBottomImageBeforeUpload(){
	$("#shopBottomImage").attr("src","/assets/images/cms/loading.gif");
}
function addShopBottomImageAfterUpload(imageSrc){
	$("#shopBottomImage").attr("src",imageSrc);
	modifyShopImg('bottom',imageSrc);
}
function saveShopInfo(){
	var shopInfo = new Object();
	shopInfo.info = shopInfoEditor.html();
	dataHandler('modify','shopInfo',shopInfo,null,null,null,'Success',true);
}
function uploadCSV(formId){
	uploadImageAdvance(formId,addCSVBeforeUpload,addCSVAfterUpload);
}
function addCSVBeforeUpload(){
//	$("#shopBottomImage").attr("src","/assets/images/cms/loading.gif");
}
function addCSVAfterUpload(src){
//	$("#shopBottomImage").attr("src",src);
	addCSV(src);
}
function addCSV(src){
	var csv = new Object();
	csv.src = src;
	dataHandler('upload','csv',csv,null,'Are you sure to add all items?',null,'Success',true);
}