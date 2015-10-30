$(document).ready(function(){
	$("#bkDiv").click(function(){
		$(".km-modal-dialog").hide();
		$(".km-alert").hide();
		$("#bkDiv").hide();
		$("body").removeClass('km-modal-open');
	});
	$(".km-close").click(function(){
		$(".km-modal-dialog").hide();
		$("#bkDiv").hide();
		$("body").removeClass('km-modal-open');
	});
	$(".km-btn-close").click(function(){
		$(".km-modal-dialog").hide();
		$("#bkDiv").hide();
		$("body").removeClass('km-modal-open');
	});
});
/**
 * 让指定的DIV始终显示在屏幕正中间
 */
function setDivCenter(divId,bk){  
	var top = ($(window).height() > $(divId).height())?($(window).height() - $(divId).height())/2:0;   
	var left = ($(window).width() - $(divId).width())/2;   
	var scrollTop = $(document).scrollTop();   
	var scrollLeft = $(document).scrollLeft();   
	$(divId).css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show(100);
	if(bk) $("#bkDiv").show();
	$("body").addClass('km-modal-open');
}
function removeDiv(divId){  
	$(divId).hide(100);
	$("#bkDiv").hide(100);
}
function showWait(){
	setDivCenter("#waitDiv",true);
}
function closeWait(){
	removeDiv("#waitDiv");
}
/*
function showMsg(msg){
	$("#msgBox").show();
	$("#newMsg").text(msg);
	var d = new Date();
	var timeStr = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
	$("#msgTime").text(timeStr);
	setTimeout(closeMsg,2500);
}
function closeMsg(){
	$("#msgBox").hide();
}*/

/**
 * type:success,warning,info,danger
 */
function showAlert(type,strong,msg){
	$('#messageAlert').children('strong').text(strong);
	$('#messageAlert').children('.km-alert-msg').text(msg);
	$('#messageAlert').addClass('km-alert-'+type);
	setDivCenter('#messageAlert',true)
	setTimeout(closeAlert,2500);
}
function closeAlert(){
	$(".km-modal-dialog").hide();
	$(".km-alert").hide();
	$("#bkDiv").hide();
	$("body").removeClass('km-modal-open');
	$('#messageAlert').removeClass('km-alert-success','km-alert-warning','km-alert-info','km-alert-danger');
}
function jumpPage(url){
	var pageNum=$('#page_num').val();
	if(pageNum!=null && pageNum>0)
		location.href=url+pageNum;
	else
		alert("请输入正确页数!");
}
function getThumb(wraperId){
	var objJson = [];
	$(wraperId).each(function(index){
		objJson.push(jQuery.parseJSON('{"src":"' + $(this).find('.thumb-src').attr("src") + '"}')); 
	})
	return objJson;
}
/**
 * 数据与后台交互
 * (object)postData
 * 默认值：callBack="NoCallBack",confirmMsg="NoConfirmation",refresh=false
 */
function dataHandler(url,postDataObj,confirmMsg,cancelCallBack,successMsg,callBack,refresh,ifShowWait){
	if(confirmMsg && !confirm(confirmMsg)){
		if(cancelCallBack) cancelCallBack();
		return false;
	}
	if(ifShowWait){
		showWait();
	}
	$.post(
		url,
		{
			'data':JSON.stringify(postDataObj)
		},
		function(data){
			var result=$.parseJSON(data);
			if(result.result=="success"){
				if(successMsg) showMsg(successMsg);
				if(callBack) callBack(result.message);
				if(refresh) location.reload();
			}else{
				alert(result.message);
			}
			if(ifShowWait){
				closeWait();
			}
		});
}
/*
function addImage(){
	$("#file").click();
}*/
function uploadImage(beforeUpload,successHandler){
	$("#upload_image_form").ajaxSubmit({
		success: function (data) {
			var result=$.parseJSON(data);
			if(result.code){
				successHandler(result.message);
			}else{
				alert(result.message);
			}
		},
		url: "/common/uploadImage",
		data: $("#upload_image_form").formSerialize(),
		type: 'POST',
		beforeSubmit: function () {
			beforeUpload();
		}
	});
	return false;
}
function uploadImageAdvance(formId,beforeUpload,successHandler){
	$(formId).ajaxSubmit({
		success: function (data) {
			var result=$.parseJSON(data);
			if(result.code){
				successHandler(result.message);
			}else{
				alert(result.message);
			}
		},
		url: "/common/uploadImage",
		data: $(formId).formSerialize(),
		type: 'POST',
		beforeSubmit: function () {
			beforeUpload();
		}
	});
	return false;
}
function language(language){
	$.post(
	"/common/setLanguage",
	{
		'language':language
	},
	function(data){
		location.reload();
	});
}
function refreshCode(){
	$("#validCodeImg").attr("src","/common/createVeriCode");
}
function isEmail(str){ 
	var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
	return reg.test(str); 
}
function dateFormat (formatStr,time){   
    var str = formatStr;   
    var Week = ['日','一','二','三','四','五','六'];  
  	
    str=str.replace(/yyyy|YYYY/,time.getFullYear());   
    str=str.replace(/yy|YY/,(time.getYear() % 100)>9?(time.getYear() % 100).toString():'0' + (time.getYear() % 100));   
  	var month=time.getMonth()+1;
    str=str.replace(/MM/,month>9?month.toString():'0' + month);   
    str=str.replace(/M/g,month);   
  
    str=str.replace(/w|W/g,Week[time.getDay()]);   
  
    str=str.replace(/dd|DD/,time.getDate()>9?time.getDate().toString():'0' + time.getDate());   
    str=str.replace(/d|D/g,time.getDate());   
  
    str=str.replace(/hh|HH/,time.getHours()>9?time.getHours().toString():'0' + time.getHours());   
    str=str.replace(/h|H/g,time.getHours());   
    str=str.replace(/mm/,time.getMinutes()>9?time.getMinutes().toString():'0' + time.getMinutes());   
    str=str.replace(/m/g,time.getMinutes());   
  
    str=str.replace(/ss|SS/,time.getSeconds()>9?time.getSeconds().toString():'0' + time.getSeconds());   
    str=str.replace(/s|S/g,time.getSeconds());   
  
    return str;   
} 
/*
function mainCategoryChange(){
	var category = new Object(); 
	category.id = $("#MainCategory").val();
	dataHandler('get','subCat',category,updateSubCategory,null,null,null,false);
	stSubCategoryChange();
}
function stSubCategoryChange(){
	var category = new Object(); 
	category.id = $("#stSubCategory").val();
	dataHandler('get','subCat',category,updateSubSubCategory,null,null,null,false);
}
function updateSubCategory(category){
	var subCategory=category.subCats;
	var subCats='<option value="-1">== 1st Sub Category ==</option>';
	for(var index in subCategory){ 
        subCats+='<option value="'+subCategory[index].category_id+'">'+subCategory[index].category_name+'</option>';
    }
	$("#stSubCategory").html(subCats);
}
function updateSubSubCategory(subCategory){
	var subSubCategory=subCategory.subCats;
	var subCats='<option value="-1">== 2nd Sub Category ==</option>';
	for(var index in subSubCategory){ 
        subCats+='<option value="'+subSubCategory[index].category_id+'">'+subSubCategory[index].category_name+'</option>';
    }
	$("#ndSubCategory").html(subCats);
}
//搜索
function search(){
	var p_name="";
	var p_listed="";
	if($("#type").val()!=undefined){
		p_name=$("#p_name").val();
		if($("#p_listed option:selected").val()!=undefined){
			p_listed=$("#p_listed option:selected").val()!="all"?"&listed="+$("#p_listed option:selected").val():"";
		}
		location.href="/merchant/"+$("#type").val()+"?name="+p_name+p_listed;
	}
	else{
	alert("没有商品可搜索！");}
	
}

function scroll_delete(scrollid,order,amount){
	if(confirm("确定删除该滚动图片？")){
		$.post(
			"/kmadmin/admin/del_info",
			{
				'info_type':"scroll",
				'scrollid':scrollid,
				'order':order,
				'amount':amount
			},
			function(data){
				var result=$.parseJSON(data);
				if(result.result=="success"){
					location.reload();
				}else{
					alert(result.message);
				}
			});
	}
}
function add_thumb(){
	$("#file").click();
}
function upload_thumb_img(form_id){
	$(form_id).ajaxSubmit({
		success: function (data) {
			var result=$.parseJSON(data);
			if(result.code){
				$("#addImgList div img").attr("src","/assets/images/cms/appbg_ad.png");
				var new_img_item='<li onmouseover="imgover(this)" onmouseout="imgout(this)" class="img-item imagelist"><img class="thumb-src" width="77" height="77" src="'+result.message+'"><img onclick="delclick(this)" class="del-bt" title="删除该缩略图" src="/assets/images/cms/delete.png"></li>';
				$("#addImgList").before(new_img_item);
				if($("#imgListDivs").children(".imagelist").length>=3){
					$("#addImgList").hide();
				}
			}else{
				alert(result.message);
			}
		},
		url: "/cms/index/upload_img",
		data: $(form_id).formSerialize(),
		type: 'POST',
		beforeSubmit: function () {
			$("#addImgList div img").attr("src","/assets/images/cms/loading.gif");
		}
	});
	return false;
}
function uploadImg(formId,handlerCase){
	$(formId).ajaxSubmit({
		success: function (data) {
			closeWait();
			var result=$.parseJSON(data);
			if(result.code){
				handler(handlerCase,result.message);
			}else{
				alert(result.message);
			}
		},
		url: "/cms/index/upload_img",
		data: $(formId).formSerialize(),
		type: 'POST',
		beforeSubmit: function () {
			showWait();
		}
	});
	return false;
}*/