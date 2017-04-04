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
    if($("#username").val()==''){
        showAlert('danger','用户名不能为空！','');
        return false;
    }
    if($("#password").val()==''){
        showAlert('danger','密码不能为空！','');
        return false;
    }
    if($("#verificationCode").val()==''){
        showAlert('danger','验证码不能为空！','');
        return false;
    }
    var admin = new Object(); 
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.verificationCode = $("#verificationCode").val();
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
    uploadImage("#uploadImgThumb",beforeUpload,successHandler);
}
function beforeUpload(){
    $("#thumbnail").attr('src','/assets/images/loading.gif');
}
function successHandler(src){
    $("#thumbnail").attr('src',src);
}
function searchBanner(){
    var extUrl='?placeholder=true';
    if($("#logmin").val()!=''){
        extUrl+='&startTime='+$("#logmin").val();
    }
    if($("#logmax").val()!=''){
        extUrl+='&endTime='+$("#logmax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/bannerlist"+extUrl;
}
function searchBuyer(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#gender").val()!=-1) {
         extUrl+='&gender='+$("#gender").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/buyerlist"+extUrl;
}
function searchUpass(){
    var extUrl='?placeholder=true';
    if ($("#academy").val()!=-1) {
         extUrl+='&academy='+$("#academy").val();
    };
    if ($("#speciality").val()!=-1) {
         extUrl+='&speciality='+$("#speciality").val();
    };
    if ($("#class").val()!=-1) {
         extUrl+='&class='+$("#class").val();
    };
    if ($("#gender").val()!=-1) {
         extUrl+='&gender='+$("#gender").val();
    };
    if($("#student").val()!=''){
        extUrl+='&student='+$("#student").val();
    }
    if($("#course").val()!=''){
        extUrl+='&course='+$("#course").val();
    }
    location.href="/admin/upasslist"+extUrl;
}
function searchScore(){
    var extUrl='?placeholder=true';
    if ($("#academy").val()!=-1) {
         extUrl+='&academy='+$("#academy").val();
    };
    if ($("#speciality").val()!=-1) {
         extUrl+='&speciality='+$("#speciality").val();
    };
    if ($("#class").val()!=-1) {
         extUrl+='&class='+$("#class").val();
    };
    if ($("#gender").val()!=-1) {
         extUrl+='&gender='+$("#gender").val();
    };
    if ($("#unpass").val()!=-1) {
         extUrl+='&unpass='+$("#unpass").val();
    };
    if($("#student").val()!=''){
        extUrl+='&student='+$("#student").val();
    }
    if($("#course").val()!=''){
        extUrl+='&course='+$("#course").val();
    }
    if($("#ispoor").val()!=''){
        extUrl+='&ispoor='+$("#ispoor").val();
    }
    location.href="/admin/scorelist"+extUrl;
}
function searchGpa(){
    var extUrl='?placeholder=true';
    if ($("#academy").val()!=-1) {
         extUrl+='&academy='+$("#academy").val();
    };
    if ($("#speciality").val()!=-1) {
         extUrl+='&speciality='+$("#speciality").val();
    };
    if ($("#class").val()!=-1) {
         extUrl+='&class='+$("#class").val();
    };
    if ($("#gpalower").val()!='') {
         extUrl+='&gpalower='+$("#gpalower").val();
    };
    if ($("#gpaupper").val()!='') {
         extUrl+='&gpaupper='+$("#gpaupper").val();
    };
    if($("#student").val()!=''){
        extUrl+='&student='+$("#student").val();
    }
    if($("#speorder").val()!=''){
        extUrl+='&speorder='+$("#speorder").val();
    }
    if($("#ispoor").val()!=''){
        extUrl+='&ispoor='+$("#ispoor").val();
    }
    location.href="/admin/gpalist"+extUrl;
}
function searchScholarship(){
    var extUrl='?placeholder=true';
    if ($("#academy").val()!=-1) {
         extUrl+='&academy='+$("#academy").val();
    };
    if ($("#speciality").val()!=-1) {
         extUrl+='&speciality='+$("#speciality").val();
    };
    if ($("#class").val()!=-1) {
         extUrl+='&class='+$("#class").val();
    };
    if ($("#scholarshiptype").val()!=-1) {
         extUrl+='&scholarshiptype='+$("#scholarshiptype").val();
    };
    if ($("#scholarshiptime").val()!=-1) {
         extUrl+='&scholarshiptime='+$("#scholarshiptime").val();
    };
    if($("#student").val()!=''){
        extUrl+='&student='+$("#student").val();
    }
    if($("#ispoor").val()!=''){
        extUrl+='&ispoor='+$("#ispoor").val();
    }
    location.href="/admin/scholarshiplist"+extUrl;
}
function searchMotiScholarship(){
    var extUrl='?placeholder=true';
    if ($("#academy").val()!=-1) {
         extUrl+='&academy='+$("#academy").val();
    };
    if ($("#speciality").val()!=-1) {
         extUrl+='&speciality='+$("#speciality").val();
    };
    if ($("#class").val()!=-1) {
         extUrl+='&class='+$("#class").val();
    };
    if ($("#gender").val()!=-1) {
         extUrl+='&gender='+$("#gender").val();
    };
    if($("#student").val()!=''){
        extUrl+='&student='+$("#student").val();
    }
    if($("#ispoor").val()!=''){
        extUrl+='&ispoor='+$("#ispoor").val();
    }
    location.href="/admin/motischolarshiplist"+extUrl;
}
function searchExpense(){
    var extUrl='?placeholder=true';
    if ($("#academy").val()!=-1) {
         extUrl+='&academy='+$("#academy").val();
    };
    if ($("#speciality").val()!=-1) {
         extUrl+='&speciality='+$("#speciality").val();
    };
    if ($("#class").val()!=-1) {
         extUrl+='&class='+$("#class").val();
    };
    if ($("#gender").val()!=-1) {
         extUrl+='&gender='+$("#gender").val();
    };
    if ($("#exprank").val()!=-1) {
         extUrl+='&exprank='+$("#exprank").val();
    };
    if($("#student").val()!=''){
        extUrl+='&student='+$("#student").val();
    }
    if($("#explower").val()!=''){
        extUrl+='&explower='+$("#explower").val();
    }
    if($("#expupper").val()!=''){
        extUrl+='&expupper='+$("#expupper").val();
    }
    location.href="/admin/expenselist"+extUrl;
}
function searchAssistantship(){
    var extUrl='?placeholder=true';
    if ($("#academy").val()!=-1) {
         extUrl+='&academy='+$("#academy").val();
    };
    if ($("#speciality").val()!=-1) {
         extUrl+='&speciality='+$("#speciality").val();
    };
    if ($("#class").val()!=-1) {
         extUrl+='&class='+$("#class").val();
    };
    if ($("#gender").val()!=-1) {
         extUrl+='&gender='+$("#gender").val();
    };
    if($("#student").val()!=''){
        extUrl+='&student='+$("#student").val();
    }
    location.href="/admin/assistantshiplist"+extUrl;
}
function searchSellerMarket(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    // if ($("#gender").val()!=-1) {
    //      extUrl+='&gender='+$("#gender").val();
    // };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/sellermarketlist"+extUrl;
}
function searchSellerDelivery(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    // if ($("#gender").val()!=-1) {
    //      extUrl+='&gender='+$("#gender").val();
    // };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/sellerdeliverylist"+extUrl;
}
function searchSellerPick(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    // if ($("#gender").val()!=-1) {
    //      extUrl+='&gender='+$("#gender").val();
    // };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/sellerpicklist"+extUrl;
}
function searchSuperMarket(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#type").val()!=-1) {
         extUrl+='&type='+$("#type").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/supermarketlist"+extUrl;
}
function searchProduct(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    if ($("#category").val()!=-1) {
         extUrl+='&categoryid='+$("#category").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/productlist"+extUrl;
}
function searchOrder(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/orderlist"+extUrl;
}
function searchComment(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/commentlist"+extUrl;
}
function searchAddress(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/addresslist"+extUrl;
}
function searchCoupon(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    // if($("#keywords").val()!=''){
    //     extUrl+='&keywords='+$("#keywords").val();
    // }
    location.href="/admin/couponlist"+extUrl;
}
function searchAdvice(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/advicelist"+extUrl;
}
function searchCategory(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/categorylist"+extUrl;
}
function saveBanner(isNew,isDraft){
    if($("#title").val()==''){
        alert('标题不能为空！');
        $("#title").focus();
        return false;
    }
    showWait();
    var banner = new Object(); 
    banner.infoType = 'banner';
    banner.title = $("#title").val();
    banner.introduction = $("#introduction").val();
    banner.order = $("#orderNumber").val();
    banner.thumbnail = $("#thumbnail").attr('src');
    banner.content = contentEditor.html();
    if(isDraft){
        banner.draft = 1;
    }else{
        banner.draft = 0;
    }
    var method='add';
    if(!isNew){
        banner.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',banner,null,null,null,addBannerSuccessHandler,false,false);
    
}
function addBannerSuccessHandler(){
    $("#waitDiv").hide(100);
    showAlert('success','保存成功！正在刷新...','');
    setTimeout(function(){
        location.reload();
    },2000);
}
function saveAboutus(isNew){
    if($("#role").val()==''){
        alert('请选择客户端！');
        $("#role").focus();
        return false;
    }
    if($("#version").val()==''){
        alert('请输入版本号！');
        $("#version").focus();
        return false;
    }
    if($("#thumbnail").attr('src')==''){
        alert('请选择Logo！');
        return false;
    }
    if($("#appname").val()==''){
        alert('请输入App名称！');
        $("#appname").focus();
        return false;
    }
    showWait();
    var aboutus = new Object(); 
    aboutus.infoType = 'aboutus';
    aboutus.role = $("#role").val();
    aboutus.version = $("#version").val();
    aboutus.appname = $("#appname").val();
    aboutus.logo = $("#thumbnail").attr('src');
    aboutus.content = contentEditor.html();
    var method='add';
    if(!isNew){
        aboutus.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',aboutus,null,null,null,addBannerSuccessHandler,false,false);
}
function saveSeller(isNew,callBack){
    showWait();
    var seller = new Object(); 
    seller.infoType = 'seller';
    seller.role = $("#role").val();
    seller.sid = $("#subsupermarket").val();
    seller.workno = $("#workno").val();
    seller.name = $("#name").val();
    seller.gender = $("input[name='gender']:checked").val();
    seller.phone = $("#phone").val();
    if($("#password").length > 0){
        seller.password = $("#password").val();
    }
    seller.status = $("input[name='status']:checked").val();
    seller.photo = $("#thumbnail").attr('src');
    var method='add';
    if(!isNew){
        seller.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',seller,null,null,null,callBack,false,false);
}
function saveCoupon(isNew,callBack){
    if($("#useprice").val()<$("#facevalue").val()){
        alert('使用条件不能小于面值！');
        return false;
    }
    showWait();
    var coupon = new Object(); 
    coupon.infoType = 'coupons';
    coupon.sid = $("#subsupermarket").val();
    coupon.buyerid = $("#buyer").val();
    coupon.facevalue = $("#facevalue").val();
    coupon.useprice = $("#useprice").val();
    coupon.beginvalid = $("#datemin").val();
    coupon.endvalid = $("#datemax").val();
    coupon.pushmsg = $("input[name='pushmsg']:checked").val();
    var method='add';
    if(!isNew){
        coupon.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'BulkInfo',coupon,null,null,null,callBack,false,false);
}
function saveSubSuperMarket(isNew,callBack){
    showWait();
    var subsupermarket = new Object(); 
    subsupermarket.infoType = 'supermarket';
    subsupermarket.supermarket = $("#supermarket").val();
    subsupermarket.sno = $("#sno").val();
    subsupermarket.sname = $("#sname").val();
    subsupermarket.province = $("#province").val();
    subsupermarket.city = $("#city").val();
    subsupermarket.area = $("#area").val();
    subsupermarket.detailedarea = $("#detailedarea").val();
    subsupermarket.logo = $("#thumbnail").attr('src');
    subsupermarket.lng = $("#lng").val();
    subsupermarket.lat = $("#lat").val();
    subsupermarket.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew){
        subsupermarket.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',subsupermarket,null,null,null,callBack,false,false);
}
function saveSuperMarket(isNew,callBack){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'supermarket';
    supermarket.no = $("#no").val();
    supermarket.sno = $("#sno").val();
    supermarket.name = $("#name").val();
    supermarket.logo = $("#thumbnail").attr('src');
    supermarket.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew){
        supermarket.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',supermarket,null,null,null,callBack,false,false);
}
function saveCategory(isNew,callBack){
    showWait();
    var category = new Object(); 
    category.infoType = 'category';
    category.sid = $("#supermarket").val();
    category.order = $("#order").val();
    category.name = $("#name").val();
    var method='add';
    if(!isNew){
        category.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',category,null,null,null,callBack,false,false);
}
function saveSellerPassword(callBack){
    showWait();
    var seller = new Object(); 
    seller.infoType = 'seller';
    seller.id = $("#id").val();
    seller.password = $("#new-password").val();
    dataHandler('/common/modifyInfo',seller,null,null,null,callBack,false,false);
}
function getSubSupermarkets(){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'subSupermarkets';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getSubSupermarketsSuccess,false,false);
}
function getSubSupermarketsSuccess(subSupermarkets){
    var htmlOption='<option value="" selected>请选择具体超市</option>';
    for (var i = 0; i < subSupermarkets.length; i++) {
        htmlOption+='<option value="'+subSupermarkets[i].id+'">'+subSupermarkets[i].sname+'</option>'
    };
    $("#subsupermarket").html(htmlOption);
    closeWait();
}
function getCategories(){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'categories';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getCategoriesSuccess,false,false);
}
function getCategoriesSuccess(categories){
    var htmlOption='<option value="" selected>请选择分类</option>';
    for (var i = 0; i < categories.length; i++) {
        htmlOption+='<option value="'+categories[i].id+'">'+categories[i].name+'</option>'
    };
    $("#category").html(htmlOption);
    closeWait();
}
function getSelectCategories(){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'categories';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getSelectCategoriesSuccess,false,false);
}
function getSelectCategoriesSuccess(categories){
    var htmlOption='<option value="-1" selected>所有</option>';
    for (var i = 0; i < categories.length; i++) {
        htmlOption+='<option value="'+categories[i].id+'">'+categories[i].name+'</option>'
    };
    $("#category").html(htmlOption);
    closeWait();
}
function setSupermarketLogo(){
  if($("#supermarket").val()!=''){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'supermarket';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getSupermarketSuccess,false,false);
    
  }
}
function getSupermarketSuccess(supermarket){
    $("#thumbnail").attr('src',supermarket.logo);
    closeWait();
}
function saveUpass(isNew){
    showWait();
    var upass = new Object();
    var student = new Object();
    upass.infoType = 'upass';
    upass.score_ordinary = $("#score_ordinary").val();
    upass.score_term = $("#score_term").val();
    upass.score = $("#score").val();
    student.id = $("#studentId").val();
    student.number = $("#studentNumber").val();
    student.name = $("#studentName").val();
    student.gender = $("input[name='gender']:checked").val();
    upass.student=student;
    var method='add';
    if(!isNew){
        upass.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',upass,null,null,null,addSuccessHandler,false,false);
}
function saveScore(isNew){
    showWait();
    var score = new Object();
    var student = new Object();
    score.infoType = 'score';
    score.score_ordinary = $("#score_ordinary").val();
    score.score_term = $("#score_term").val();
    score.score = $("#score").val();
    student.id = $("#studentId").val();
    student.number = $("#studentNumber").val();
    student.name = $("#studentName").val();
    student.gender = $("input[name='gender']:checked").val();
    score.student=student;
    var method='add';
    if(!isNew){
        score.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',score,null,null,null,addSuccessHandler,false,false);
}
function addSuccessHandler(){
    $("#waitDiv").hide(100);
    showAlert('success','保存成功！正在刷新...','');
    setTimeout(function(){
        location.reload();
    },2000);
}
// function uploadThumb1(){
//     uploadImageAdvance("#uploadImgThumb1",beforeUpload1,successHandler1);
// }
// function beforeUpload1(){
//     $("#thumbnail1").attr('src','/assets/images/cms/loading.gif');
// }
// function successHandler1(src){
//     $("#thumbnail1").attr('src',src);
// }
// function uploadThumb2(){
//     uploadImageAdvance("#uploadImgThumb2",beforeUpload2,successHandler2);
// }
// function beforeUpload2(){
//     $("#thumbnail2").attr('src','/assets/images/cms/loading.gif');
// }
// function successHandler2(src){
//     $("#thumbnail2").attr('src',src);
// }
// function uploadThumb3(){
//     uploadImageAdvance("#uploadImgThumb3",beforeUpload3,successHandler3);
// }
// function beforeUpload3(){
//     $("#thumbnail3").attr('src','/assets/images/cms/loading.gif');
// }
// function successHandler3(src){
//     $("#thumbnail3").attr('src',src);
// }
// function showAddEssayDiv(){
//     setDivCenter('#addEssayDiv',true);
// }
// function addEssay(){
//     if($("#title").val()==''){
//         alert('标题不能为空！');
//         $("#title").focus();
//         return false;
//     }
//     $("#addEssayDiv").hide(100);
//     showWait();
//     var essay = new Object(); 
//     essay.infoType = 'essay';
//     essay.column = $("#column").val();
//     essay.title = $("#title").val();
//     essay.islink = $("#islink").val();
//     essay.link = $("#link").val();
//     essay.summary = $("#summary").val();
//     essay.thumbnail = $("#thumbnail").attr('src');
//     essay.content = contentEditor.html();
//     if($("#author").length > 0){
//         essay.author = $("#author").val();
//     }
//     if($("#thumbnail2").length > 0){
//         essay.avatar = $("#thumbnail2").attr('src');
//     }
//     dataHandler('/common/addInfo',essay,null,null,null,addEssaySuccessHandler,false,false);
    
// }
// function saveEssay(){
//     if($("#title1").val()==''){
//         alert('标题不能为空！');
//         $("#title").focus();
//         return false;
//     }
//     $("#editEssayDiv").hide();
//     showWait();
//     var essay = new Object();
//     essay.infoType = 'essay';
//     essay.id = currentEssayId;
//     essay.column = $("#column1").val();
//     essay.title = $("#title1").val();
//     essay.islink = $("#islink1").val();
//     essay.link = $("#link1").val();
//     essay.summary = $("#summary1").val();
//     essay.thumbnail = $("#thumbnail1").attr('src');
//     essay.content = contentEditor1.html();
//     if($("#author1").length > 0){
//         essay.author = $("#author1").val();
//     }
//     if($("#thumbnail3").length > 0){
//         essay.avatar = $("#thumbnail3").attr('src');
//     }
//     dataHandler('/common/modifyInfo',essay,null,null,null,saveEssaySuccessHandler,false,false);
    
// }
// function saveEssaySuccessHandler(){
//     $("#waitDiv").hide(100);
//     showAlert('success','修改成功！','');
//     reload();
// }
// var currentEssayId=0;
// function editEssay(id){
//     showWait();
//     currentEssayId=id;
//     var essay = new Object(); 
//     essay.infoType = 'essay';
//     essay.id = id;
//     dataHandler('/common/getInfo',essay,null,null,null,getEssaySuccessHandler,false,false);
// }
// function getEssaySuccessHandler(essay){
//     $("#title1").val(essay.title);
//     $("#summary1").val(essay.summary);
//     $("#islink1").val(essay.islink);
//     if(essay.islink==1){
//         $("#link1").show();
//     }else{
//         $("#link1").hide();
//     }
//     if($("#author1").length > 0){
//         $("#author1").val(essay.author);
//     }
//     if($("#thumbnail3").length > 0){
//         $("#thumbnail3").attr('src',essay.authorAvatar);
//     }
//     $("#link1").val(essay.link);
//     $("#column1").val(essay.column);
//     contentEditor1.html(essay.content);
//     $("#thumbnail1").attr('src',essay.thumbnail);
//     $("#waitDiv").hide(100);
//     setDivCenter('#editEssayDiv',true);
// }
// function deleteEssay(id){
//     var essay = new Object(); 
//     essay.infoType = 'essay';
//     essay.id = id;
//     dataHandler('/common/deleteInfo',essay,'确定删除？',null,null,deleteEssaySuccessHandler,false,false);
// }
// function deleteEssaySuccessHandler(){
//     showAlert('success','删除成功！','正在刷新...');
//     reload();
// }
// function selectEssay(baseUrl){
//     var extUrl="";
//     if($("#searchColumn").val()!=0) extUrl+="&column="+$("#searchColumn").val();
//     if($("#keywords").val()!="") extUrl+="&keywords="+$("#keywords").val();
//     location.href=baseUrl+extUrl;
// }