<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class GetData{
	var $CI;
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model("dbHandler");
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
	public function getEssays($parameters){
		$condition=array(
			'table'=>'essay',
			'result'=>$parameters['result']
		);
		if(isset($parameters['column'])){
			$condition['where']['column']=$parameters['column'];
		}
		if(isset($parameters['columns'])){
			$condition['where_in']=array('column'=>$parameters['columns']);
		}
		if(isset($parameters['nocolumns'])){
			$condition['where_not_in']=array('column'=>$parameters['nocolumns']);
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['like']=array('title'=>$parameters['keywords']);
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['time >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['time <=']=$parameters['time']['end'];
			}
		}
		$essays=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($essays as $key => $value) {
				$value->columnName=$this->getContent('column',$value->column)->name;
			}
		}
		return $essays;
	}
	public function getUsers($parameters){
		$condition=array(
			'table'=>'user',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['like']=array('username'=>$parameters['keywords']);
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['time >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['time <=']=$parameters['time']['end'];
			}
		}
		$users=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($users as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $users;
	}
	public function getColumns($type,$isOnlyId){
		switch ($type) {
			case 'home'://首页
				$columns = array(1,2,3);
				break;
			case 'products'://产品
				$columns = array(4);
				break;
			case 'forum'://论坛
				$columns = array(5);
				break;
			case 'activity'://品牌活动
				$columns = array(6);
				break;
			
			default:
				
				break;
		}
		$returnData=array();
		if($isOnlyId){
			$returnData=$columns;
		}else{
			foreach ($columns as $value) {
				$item=$this->getContent('column',$value);
				$returnData[]=$item;
			}
		}
		return $returnData;
	}
}

/* End of file Common.php */