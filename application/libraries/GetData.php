<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class GetData{
	var $CI;
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model("dbHandler");
		$this->CI->load->helper("qrcode");
	}
	/**
	 * 获取网站配置信息
	 * return array or string
	 */
	public function getWebsiteConfig($info="ALLINFO"){
		$condition=array(
			'table'=>'websiteconfig',
			'result'=>'data'
		);
		if($info!="ALLINFO") $condition['where']=array('key_websiteconfig'=>$info);
		$result=$this->CI->dbHandler->selectData($condition);
		if($info!="ALLINFO") return $result[0]->value_websiteconfig;
		else {
			$newArray=array();
			foreach($result as $value){
				$newArray[$value->key_websiteconfig]=$value->value_websiteconfig;
			}
			return $newArray;
		}
	}
	public function language($type='home'){
		$this->CI->load->helper('language');
		if(isset($_SESSION['language'])){
			if($_SESSION['language']=="english"){
				$this->CI->config->set_item('language', 'english');
				$this->CI->load->language($type,'english');
				return true;
			}elseif($_SESSION['language']=="tw_cn"){
				$this->CI->config->set_item('language', 'tw_cn');
				$this->CI->load->language($type,'tw_cn');
				return true;
			}else{
				$this->CI->config->set_item('language', 'zh_cn');
				$this->CI->load->language($type,'zh_cn');
				return true;
			}
		}
		//判断浏览器语言
		$default_lang_arr = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$strarr = explode(",",$default_lang_arr);
		$default_lang = $strarr[0];
//		echo '1'.$default_lang;
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4); //只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。  
		if (preg_match("/en/i", $lang)){ 
			$this->CI->config->set_item('language', 'english');
			// 根据设置的语言类型加载语言包
			$this->CI->load->language($type,'english');
			$_SESSION['language']='english';
		}
		elseif (preg_match("/zh-c/i", $lang)){
			$this->CI->config->set_item('language', 'zh_cn');
			$this->CI->load->language($type,'zh_cn');
			$_SESSION['language']='zh_cn';
		}
		elseif (preg_match("/zh/i", $lang)){ 
			$this->CI->config->set_item('language', 'tw_cn');
			$this->CI->load->language($type,'tw_cn');
			$_SESSION['language']='tw_cn';
		}else{
			$this->CI->config->set_item('language', 'zh_cn');
			$this->CI->load->language($type,'zh_cn');
			$_SESSION['language']='zh_cn';
		}
/*		// 根据浏览器类型设置语言
		if($default_lang == 'en-us' || $default_lang == 'en'){
			$this->CI->config->set_item('language', 'english');
			// 根据设置的语言类型加载语言包
			$this->CI->load->language('cms','english');
		}elseif( $default_lang == 'en-us' || $default_lang=='zh-CN'){
			$this->CI->config->set_item('language', 'zh_cn');
			$this->CI->load->language('cms','zh_cn');
		}
		// 当前语言
		echo $this->CI->config->item('language');*/
	}
	/**
	 * 获取一条信息
	 * return object
	 */
	public function getOneData($condition){
		$data=$this->CI->dbHandler->selectData($condition);
		if(sizeof($data)>0)
			return $data[0];
		else{
			$returnData= new stdClass();
			return $returnData;
		}
	}
	public function getContent($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('id'=>$contentId)
		);
		return $this->getOneData($condition);
	}
	public function getContentAdvance($type,$where){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>$where
		);
		return $this->getOneData($condition);
	}
	public function getData($condition){
		return $this->CI->dbHandler->selectData($condition);
	}
	public function getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount){
		$pageAmount=ceil($amount/$amountPerPage);
		$page=array(
			'firstPage'=>($currentPage!=1)?$baseUrl.'&page=1':'no',
			'lastPage'=>($currentPage!=$pageAmount && $pageAmount!=0)?$baseUrl.'&page='.$pageAmount:'no',
			'prevPage'=>($currentPage>1)?$baseUrl.'&page='.($currentPage-1):'no',
			'nextPage'=>($currentPage<$pageAmount)?$baseUrl.'&page='.($currentPage+1):'no',
			'jumpPage'=>$baseUrl.'&page=',
			'selectPage'=>$selectUrl,
			'currentPage'=>$currentPage,
			'pageAmount'=>$pageAmount,
			'amount'=>$amount,
			'limit'=>array('offset'=>$amountPerPage*($currentPage-1),'limit'=>$amountPerPage)
		);
		return $page;
	}
	// public function getEssays($parameters){
	// 	$condition=array(
	// 		'table'=>'essay',
	// 		'result'=>$parameters['result']
	// 	);
	// 	if(isset($parameters['column'])){
	// 		$condition['where']['column']=$parameters['column'];
	// 	}
	// 	if(isset($parameters['columns'])){
	// 		$condition['where_in']=array('column'=>$parameters['columns']);
	// 	}
	// 	if(isset($parameters['nocolumns'])){
	// 		$condition['where_not_in']=array('column'=>$parameters['nocolumns']);
	// 	}
	// 	if(isset($parameters['orderBy'])){
	// 		$condition['order_by']=$parameters['orderBy'];
	// 	}
	// 	if(isset($parameters['keywords'])){
	// 		$condition['like']=array('title'=>$parameters['keywords']);
	// 	}
	// 	if(isset($parameters['limit'])){
	// 		$condition['limit']=$parameters['limit'];
	// 	}
	// 	if(isset($parameters['time'])){
	// 		if(isset($parameters['time']['begin'])){
	// 			$condition['where']['time >=']=$parameters['time']['begin'];
	// 		}
	// 		if(isset($parameters['time']['end'])){
	// 			$condition['where']['time <=']=$parameters['time']['end'];
	// 		}
	// 	}
	// 	$essays=$this->getData($condition);
	// 	if($parameters['result']=='data'){
	// 		foreach ($essays as $key => $value) {
	// 			$value->columnName=$this->getContent('column',$value->column)->name;
	// 		}
	// 	}
	// 	return $essays;
	// }
	public function getBanners($parameters){
		$condition=array(
			'table'=>'banner',
			'result'=>$parameters['result']
		);
		if(isset($parameters['draft'])){
			$condition['where']=array('draft'=>$parameters['draft']);
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}else{
			$condition['order_by']=array('order'=>'ASC');
		}
		if(isset($parameters['keywords'])){
			$condition['like']=array('title'=>$parameters['keywords']);
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		$banners=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($essays as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $banners;
	}
	public function getBuyers($parameters){
		$condition=array(
			'table'=>'buyer',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		$buyers=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->supermarket=$this->getContent('supermarket',$value->defaultsid);
			}
		}
		return $buyers;
	}
	public function getProducts($parameters){
		$condition=array(
			'table'=>'goods',
			'result'=>$parameters['result']
		);
		if(isset($parameters['sid'])){
			$condition['where']['sid']=$parameters['sid'];
		}
		if(isset($parameters['categoryid'])){
			$condition['where']['categoryid']=$parameters['categoryid'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['name']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		$products=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($products as $key => $value) {
				$value->supermarket=$this->getContent('supermarket',$value->sid);
				$value->category=$this->getContent('category',$value->categoryid);
			}
		}
		return $products;
	}
	public function getOrders($parameters){
		$condition=array(
			'table'=>'order',
			'result'=>$parameters['result']
		);
		if(isset($parameters['sid'])){
			$condition['where']['sid']=$parameters['sid'];
		}
		if(isset($parameters['sellerid'])){
			$condition['where']['sellerid']=$parameters['sellerid'];
		}
		if(isset($parameters['buyerid'])){
			$condition['where']['buyerid']=$parameters['buyerid'];
		}
		if(isset($parameters['status'])){
			$condition['where']['status']=$parameters['status'];
		}
		if(isset($parameters['isshared'])){
			$condition['where']['isshared']=$parameters['isshared'];
		}
		if(isset($parameters['isdel'])){
			$condition['where']['isdel']=$parameters['isdel'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['orderno']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		$orders=$this->getData($condition);
		$status=$this->getOrderStatus();
		if($parameters['result']=='data'){
			foreach ($orders as $key => $value) {
				$value->supermarket=$this->getContent('supermarket',$value->sid);
				$value->buyer=$this->getContent('buyer',$value->buyerid);
				$value->seller=$this->getContent('seller',$value->sellerid);
				$value->address=$this->getContent('address',$value->addressid);
				$value->coupon=$this->getContent('coupon',$value->couponid);
				$value->details=$this->getOrderDetail($value->orderno);
				$value->status_zn=$status[$value->status];
			}
		}
		return $orders;
	}
	public function getAddresses($parameters){
		$condition=array(
			'table'=>'address',
			'result'=>$parameters['result']
		);
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['name']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
			$condition['or_like_bracket']['detailedarea']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		$addresses=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($addresses as $key => $value) {
				$value->buyer=$this->getContent('buyer',$value->buyerid);
			}
		}
		return $addresses;
	}
	public function getComments($parameters){
		$condition=array(
			'table'=>'comment',
			'result'=>$parameters['result']
		);
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['orderno']=$parameters['keywords'];
			$condition['or_like_bracket']['content']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		$comments=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($comments as $key => $value) {
				$value->buyer=$this->getContent('buyer',$value->buyerid);
			}
		}
		return $comments;
	}
	public function getCoupons($parameters){
		$condition=array(
			'table'=>'coupon',
			'result'=>$parameters['result']
		);
		if(isset($parameters['sid'])){
			$condition['where']['sid']=$parameters['sid'];
		}
		if(isset($parameters['buyerid'])){
			$condition['where']['buyerid']=$parameters['buyerid'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		// if(isset($parameters['keywords'])){
		// 	$condition['or_like_bracket']['orderno']=$parameters['keywords'];
		// 	$condition['or_like_bracket']['content']=$parameters['keywords'];
		// }
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		$coupons=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($coupons as $key => $value) {
				$value->supermarket=$this->getContent('supermarket',$value->sid);
				$value->buyer=$this->getContent('buyer',$value->buyerid);
			}
		}
		return $coupons;
	}
	public function getOrderStatus(){
		$status=array(
			'0'=>'未完成扫描',
			'1'=>'待付款',
			'2'=>'未指派',
			'3'=>'待发货',
			'4'=>'运输中',
			'5'=>'交易完成(未评价)',
			'6'=>'交易完成(已评价)',
			'-1'=>'已取消',
			'7'=>'自提'
		);
		return $status;
	}
	public function getOrderDetail($orderno){
		$parameters=array(
						'table'=>'orderitem',
						'result'=>'data',
						'where'=>array('orderno'=>$orderno)
						);
		$details=$this->getData($parameters);
		foreach ($details as $key => $value) {
			$value->product=$this->getContent('goods',$value->goodsid);
		}
		return $details;
	}
	public function getSellers($parameters){
		$condition=array(
			'table'=>'seller',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['supermarket'])){
			$condition['where']['sid']=$parameters['supermarket'];
		}
		if(isset($parameters['role'])){
			$condition['where']['role']=$parameters['role'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['workno']=$parameters['keywords'];
			$condition['or_like_bracket']['name']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
			// $condition['sql']="(`workno` LIKE '%".$parameters['keywords']."%' OR `name` LIKE '%".$parameters['keywords']."%' OR `pone` LIKE '%".$parameters['keywords']."%')";
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		$sellers=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($sellers as $key => $value) {
				$value->supermarket=$this->getContent('supermarket',$value->sid);
			}
		}
		return $sellers;
	}
	public function getAllSupermarkets($withSub=false,$asArray=false){
		$parameters=array(
			'result'=>'data',
			'type'=>0,
			'orderBy'=>array('name'=>'ASC')
		);
		$supermarkets=$this->getSupermarkets($parameters);//所有总店
		if($withSub){
			foreach ($supermarkets as $key => $value) {
				$subParameters=array(
					'result'=>'data',
					'no'=>$value->no,
					'type'=>1,
				);
				$value->subSupermarkets=$this->getSupermarkets($subParameters);//获取对应所有分店
			}
		}
		if($asArray){
			$supermarketsArray=array();
			foreach ($supermarkets as $value) {
				$supermarketsArray[$value->id]=$value;
				foreach ($value->subSupermarkets as $v) {
					$supermarketsArray[$v->id]=$v;
				}
			}
			$supermarkets=$supermarketsArray;
		}
		return $supermarkets;
	}
	public function getSubSupermarkets($sid){
		$supermarket=$this->getContent('supermarket',$sid);
		if(!isset($supermarket->no)){
			return array();
		}
		$subParameters=array(
			'result'=>'data',
			'no'=>$supermarket->no,
			'type'=>1,
		);
		$subSupermarkets=$this->getSupermarkets($subParameters);//获取对应所有分店
		return $subSupermarkets;
	}
	public function getSupermarkets($parameters){
		$condition=array(
			'table'=>'supermarket',
			'result'=>$parameters['result']
		);
		if(isset($parameters['no'])){
			$condition['where']['no']=$parameters['no'];
		}
		if(isset($parameters['sno'])){
			$condition['where']['sno']=$parameters['sno'];
		}
		if(isset($parameters['type'])){
			$condition['where']['type']=$parameters['type'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['name']=$parameters['keywords'];
			$condition['or_like_bracket']['sname']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		$supermarkets=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($supermarkets as $key => $value) {
		// 		$value->supermarket=$this->getContent('supermarket',$value->sid);
		// 	}
		// }
		return $supermarkets;
	}
	public function getCategories($parameters){
		$condition=array(
			'table'=>'category',
			'result'=>$parameters['result']
		);
		if(isset($parameters['sid'])){
			$condition['where']['sid']=$parameters['sid'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['name']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		$categories=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($categories as $key => $value) {
				$value->supermarket=$this->getContent('supermarket',$value->sid);
			}
		}
		return $categories;
	}
	// public function getColumns($type,$isOnlyId){
	// 	switch ($type) {
	// 		case 'home'://首页
	// 			$columns = array(1,2,3);
	// 			break;
	// 		case 'products'://产品
	// 			$columns = array(4);
	// 			break;
	// 		case 'forum'://论坛
	// 			$columns = array(5);
	// 			break;
	// 		case 'activity'://品牌活动
	// 			$columns = array(6);
	// 			break;
			
	// 		default:
				
	// 			break;
	// 	}
	// 	$returnData=array();
	// 	if($isOnlyId){
	// 		$returnData=$columns;
	// 	}else{
	// 		foreach ($columns as $value) {
	// 			$item=$this->getContent('column',$value);
	// 			$returnData[]=$item;
	// 		}
	// 	}
	// 	return $returnData;
	// }

	public function checkCode($code){
		if(strcasecmp($code,$_SESSION['authcode'])==0){
			return true;
		}else{
			return false;
		}
	}
	public function isExist($table,$where){
		$condition=array(
			'table'=>$table,
			'where'=>$where,
			'result'=>'count'
		);
		$number=$this->getData($condition);
		if($number<1){
			return false;
		}else{
			return true;
		}
	}
	public function isModifyExist($table,$id,$where){
		$condition=array(
			'table'=>$table,
			'where'=>$where,
			'result'=>'data'
		);
		$data=$this->getOneData($condition);
		if(isset($data->id) && $data->id!=$id){
			return true;
		}else{
			return false;
		}
	}
	public function twoDimensionCode($text,$id){
		$value = $text; //二维码内容   
		$errorCorrectionLevel = 'H';//容错级别   
		$matrixPointSize = 10;//生成图片大小    
		$QR = $_SERVER['DOCUMENT_ROOT'].'/uploads/2dcode/'.$id.'qrcode.png';//已经生成的原始二维码图    
		
		//生成二维码图片
		QRcode::png($value,$QR, $errorCorrectionLevel, $matrixPointSize, 2);
		return  $QR;
	}
	public function twoDimensionCodeWithLogo($text,$appid,$logoSrc){
		$value = $text; //二维码内容   
		$errorCorrectionLevel = 'H';//容错级别   
		$matrixPointSize = 10;//生成图片大小    
		$QR = $_SERVER['DOCUMENT_ROOT'].'/uploads/2dcode/'.$appid.'qrcode.png';//已经生成的原始二维码图    
		
		//生成二维码图片
		QRcode::png($value,$QR, $errorCorrectionLevel, $matrixPointSize, 2);
		$logo = $_SERVER['DOCUMENT_ROOT'].$logoSrc;//准备好的logo图片 
		if ($logo !== FALSE) {
			$QR = imagecreatefromstring(file_get_contents($QR));   
			$logo = imagecreatefromstring(file_get_contents($logo));   
			$QR_width = imagesx($QR);//二维码图片宽度   
			$QR_height = imagesy($QR);//二维码图片高度   
			$logo_width = imagesx($logo);//logo图片宽度   
			$logo_height = imagesy($logo);//logo图片高度   
			$logo_qr_width = $QR_width / 4;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			$from_width = ($QR_width - $logo_qr_width) / 2;
			//重新组合图片并调整大小   
			imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
			$logo_qr_height, $logo_width, $logo_height);   
		}   
		//输出图片地址
		$dstLocation='/uploads/2dcode/'.$appid.'withlogo.png';
		//输出图片   
		imagepng($QR,$_SERVER['DOCUMENT_ROOT'].$dstLocation);   
		return  $dstLocation; 
	}
}

/* End of file Common.php */