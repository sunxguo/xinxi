$(document).ready(function(){
    $(".checkall").click(function(){
        var result=$(this).prop('checked');
        $(".check").prop("checked",result);
        checkListStyle();
    });
    $(".check").click(function(){
        checkListStyle();
    });
});
function adminLogin () {
    var admin = new Object(); 
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    dataHandler('/adminajax/login',admin,null,null,null,adminLoginSuccess,false,false);
}
function adminLoginSuccess(){
    location.href='/admin/index';
}
function reload(){
    location.reload();
}
function checkListStyle(){
    var allChecked=true;
    $(".data-item").each(function(index){
        var result=$(this).find('.checker span input').prop('checked');
        if(result){
            $(this).addClass('checked');
        }else{
            allChecked=false;
            $(this).removeClass('checked');
        }
    });
    $(".checkall").prop('checked',allChecked);
}
function uploadThumb(){
    uploadImageAdvance("#uploadImgThumb",beforeUpload,successHandler);
}
function beforeUpload(){
    $("#thumbnail").attr('src','/assets/images/cms/loading.gif');
}
function successHandler(src){
    $("#thumbnail").attr('src',src);
}
function uploadThumb1(){
    uploadImageAdvance("#uploadImgThumb1",beforeUpload1,successHandler1);
}
function beforeUpload1(){
    $("#thumbnail1").attr('src','/assets/images/cms/loading.gif');
}
function successHandler1(src){
    $("#thumbnail1").attr('src',src);
}
function showAddEssayDiv(){
    setDivCenter('#addEssayDiv',true);
}
function addEssay(){
    if($("#title").val()==''){
        alert('标题不能为空！');
        $("#title").focus();
        return false;
    }
    $("#addEssayDiv").hide(100);
    showWait();
    var essay = new Object(); 
    essay.infoType = 'essay';
    essay.column = $("#column").val();
    essay.title = $("#title").val();
    essay.summary = $("#summary").val();
    essay.thumbnail = $("#thumbnail").attr('src');
    essay.content = contentEditor.html();
    dataHandler('/common/addInfo',essay,null,null,null,addEssaySuccessHandler,false,false);
    
}
function addEssaySuccessHandler(){
    $("#waitDiv").hide(100);
    showAlert('success','添加成功！','');
    reload();
}
function saveEssay(){
    if($("#title1").val()==''){
        alert('标题不能为空！');
        $("#title").focus();
        return false;
    }
    $("#editEssayDiv").hide();
    showWait();
    var essay = new Object();
    essay.infoType = 'essay';
    essay.id = currentEssayId;
    essay.column = $("#column1").val();
    essay.title = $("#title1").val();
    essay.summary = $("#summary1").val();
    essay.thumbnail = $("#thumbnail1").attr('src');
    essay.content = contentEditor1.html();
    dataHandler('/common/modifyInfo',essay,null,null,null,saveEssaySuccessHandler,false,false);
    
}
function saveEssaySuccessHandler(){
    $("#waitDiv").hide(100);
    showAlert('success','修改成功！','');
    reload();
}
var currentEssayId=0;
function editEssay(id){
    showWait();
    currentEssayId=id;
    var essay = new Object(); 
    essay.infoType = 'essay';
    essay.id = id;
    dataHandler('/common/getInfo',essay,null,null,null,getEssaySuccessHandler,false,false);
}
function getEssaySuccessHandler(essay){
    $("#title1").val(essay.title);
    $("#summary1").val(essay.summary);
    $("#column1").val(essay.column);
    contentEditor1.html(essay.content);
    $("#thumbnail1").attr('src',essay.thumbnail);
    $("#waitDiv").hide(100);
    setDivCenter('#editEssayDiv',true);
}
function deleteEssay(id){
    var essay = new Object(); 
    essay.infoType = 'essay';
    essay.id = id;
    dataHandler('/common/deleteInfo',essay,'确定删除？',null,null,deleteEssaySuccessHandler,false,false);
}
function deleteEssaySuccessHandler(){
    showAlert('success','删除成功！','正在刷新...');
    reload();
}
function selectEssay(baseUrl){
    var extUrl="";
    if($("#searchColumn").val()!=0) extUrl+="&column="+$("#searchColumn").val();
    if($("#keywords").val()!="") extUrl+="&keywords="+$("#keywords").val();
    location.href=baseUrl+extUrl;
}