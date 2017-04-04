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
			'table'=>'website_config',
			'result'=>'data'
		);
		if($info!="ALLINFO") $condition['where']=array('key'=>$info);
		$result=$this->CI->dbHandler->selectData($condition);
		if($info!="ALLINFO") return $result[0]->value;
		else {
			$newArray=array();
			foreach($result as $value){
				$newArray[$value->key]=$value->value;
			}
			return $newArray;
		}
	}
	// public function getAbout(){
	// 	$condition=array(
	// 		'table'=>'about',
	// 		'where'=>array('id'=>84),
	// 		'result'=>'data'
	// 	);
	// 	return $result=$this->CI->dbHandler->selectData($condition);
	// }
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
	public function getAcademiesByIndex(){
		$Academies=$this->getData(array('table'=>'academy','result'=>'data'));
		$AcademiesArray=array();
		foreach ($Academies as $value) {
			$AcademiesArray[$value->id]=$value;
		}
		return $AcademiesArray;
	}
	public function getSpecialitiesByIndex(){
		$Specialities=$this->getData(array('table'=>'speciality','result'=>'data'));
		$SpecialitiesArray=array();
		foreach ($Specialities as $value) {
			$SpecialitiesArray[$value->id]=$value;
		}
		return $SpecialitiesArray;
	}
	public function getClassesByIndex(){
		$classes=$this->getData(array('table'=>'class','result'=>'data'));
		$classArray=array();
		foreach ($classes as $value) {
			$classArray[$value->id]=$value;
		}
		return $classArray;
	}
	public function getSemestersByIndex(){
		$semesters=$this->getData(array('table'=>'semester','result'=>'data'));
		$semesterArray=array();
		foreach ($semesters as $value) {
			$semesterArray[$value->id]=$value;
		}
		return $semesterArray;
	}
	public function getCoursesByIndex(){
		$courses=$this->getData(array('table'=>'course','result'=>'data'));
		$courseArray=array();
		foreach ($courses as $value) {
			$courseArray[$value->id]=$value;
		}
		return $courseArray;
	}
	public function getStudentsByIndex(){
		$classes=$this->getClassesByIndex();
		$specialities=$this->getSpecialitiesByIndex();
		$academies=$this->getAcademiesByIndex();
		$students=$this->getData(array('table'=>'student','result'=>'data'));
		$stuArray=array();
		foreach ($students as $value) {
			if (isset($value->class) && $classes[$value->class]) {
				$value->classInfo=$classes[$value->class];
			}
			if (isset($value->classInfo->speciality) && $specialities[$value->classInfo->speciality]) {
				$value->specialityInfo=$specialities[$value->classInfo->speciality];
			}elseif (isset($value->speciality)) {
				$value->specialityInfo=$specialities[$value->speciality];
			}
			if (isset($value->specialityInfo->academy) && $academies[$value->specialityInfo->academy]) {
				$value->academyInfo=$academies[$value->specialityInfo->academy];
			}elseif (isset($value->academy)) {
				$value->academyInfo=$academies[$value->academy];
			}
			$stuArray[$value->id]=$value;
		}
		return $stuArray;
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
	public function getUpass($parameters){
		$condition=array(
			'table'=>'upass',
			'result'=>$parameters['result']
		);
		// if(isset($parameters['draft'])){
		// 	$condition['where']=array('draft'=>$parameters['draft']);
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }else{
		// 	$condition['order_by']=array('order'=>'ASC');
		// }
		$students_parameters=array('result'=>'data');
		
		if(isset($parameters['student'])){
			if(is_numeric($parameters['student'])){
				$students_parameters['like_number']=$parameters['student'];
			}else{
				$students_parameters['like_name']=$parameters['student'];
			}
			// $students_parameters['student']=array('student'=>$parameters['student']);
		}
		if(isset($parameters['academy']) && $parameters['academy']!=-1){
			$students_parameters['academy']=$parameters['academy'];
		}
		if(isset($parameters['speciality']) && $parameters['speciality']!=-1){
			$students_parameters['speciality']=$parameters['speciality'];
		}
		if(isset($parameters['class']) && $parameters['class']!=-1){
			$students_parameters['class']=$parameters['class'];
		}
		if(isset($parameters['gender'])){
			$students_parameters['gender']=$parameters['gender'];
		}
		$students=$this->getStudents($students_parameters);

		$courses_paremeters=array('result'=>'data');
		if (isset($parameters['course'])) {
			if(is_numeric($parameters['course'])){
				$courses_paremeters['like_code']=$parameters['course'];
			}else{
				$courses_paremeters['like_name']=$parameters['course'];
			}
		}
		$courses=$this->getCourses($courses_paremeters);

		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}

		if(sizeof($students_parameters)>1){
			if (sizeof($students)==0) {
				$condition['limit']=0;
			}else{
				$students_id=array();
				foreach ($students as $value) {
					$students_id[]=$value->id;
				}
				$condition['where_in']['stu_id']=$students_id;
			}
		}
		if(sizeof($courses_paremeters)>1){
			if (sizeof($courses)==0) {
				$condition['limit']=0;
			}else{
				$courses_id=array();
				foreach ($courses as $value) {
					$courses_id[]=$value->id;
				}
				$condition['where_in']['course']=$courses_id;
			}
		}

		// if(isset($parameters['time'])){
		// 	if(isset($parameters['time']['begin'])){
		// 		$condition['where']['addtime >=']=$parameters['time']['begin'];
		// 	}
		// 	if(isset($parameters['time']['end'])){
		// 		$condition['where']['addtime <=']=$parameters['time']['end'];
		// 	}
		// }
		$upass=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($essays as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $upass;
	}
	public function getScore($parameters){
		$condition=array(
			'table'=>'score',
			'result'=>$parameters['result']
		);
		// if(isset($parameters['draft'])){
		// 	$condition['where']=array('draft'=>$parameters['draft']);
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }else{
		// 	$condition['order_by']=array('order'=>'ASC');
		// }
		$students_parameters=array('result'=>'data');
		
		if(isset($parameters['student'])){
			if(is_numeric($parameters['student'])){
				$students_parameters['like_number']=$parameters['student'];
			}else{
				$students_parameters['like_name']=$parameters['student'];
			}
			// $students_parameters['student']=array('student'=>$parameters['student']);
		}
		if(isset($parameters['academy']) && $parameters['academy']!=-1){
			$students_parameters['academy']=$parameters['academy'];
		}
		if(isset($parameters['speciality']) && $parameters['speciality']!=-1){
			$students_parameters['speciality']=$parameters['speciality'];
		}
		if(isset($parameters['class']) && $parameters['class']!=-1){
			$students_parameters['class']=$parameters['class'];
		}
		if(isset($parameters['gender'])){
			$students_parameters['gender']=$parameters['gender'];
		}
		if(isset($parameters['ispoor'])){
			$students_parameters['ispoor']=$parameters['ispoor'];
		}
		$students=$this->getStudents($students_parameters);

		$courses_paremeters=array('result'=>'data');
		if (isset($parameters['course'])) {
			if(is_numeric($parameters['course'])){
				$courses_paremeters['like_code']=$parameters['course'];
			}else{
				$courses_paremeters['like_name']=$parameters['course'];
			}
		}
		$courses=$this->getCourses($courses_paremeters);

		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(sizeof($students_parameters)>1){
			if (sizeof($students)==0) {
				$condition['limit']=0;
			}else{
				$students_id=array();
				foreach ($students as $value) {
					$students_id[]=$value->id;
				}
				$condition['where_in']['stu_id']=$students_id;
			}
		}
		if(sizeof($courses_paremeters)>1){
			if (sizeof($courses)==0) {
				$condition['limit']=0;
			}else{
				$courses_id=array();
				foreach ($courses as $value) {
					$courses_id[]=$value->id;
				}
				$condition['where_in']['course']=$courses_id;
			}
		}
		if (isset($parameters['unpass']) && $parameters['unpass']!=-1) {
			$condition['where']['score <']=60;
			$condition['group_by']='stu_id';
			if ($parameters['unpass']==1) {
				$condition['having']['count(0) =']=1;
			}elseif ($parameters['unpass']==2) {
				$condition['having']['coun(0) =']=2;
			}elseif ($parameters['unpass']==3) {
				$condition['having']['count(0) =']=3;
			}elseif ($parameters['unpass']==4) {
				$condition['having']['count(0) >=']=4;
			}
		}
		// if(isset($parameters['time'])){
		// 	if(isset($parameters['time']['begin'])){
		// 		$condition['where']['addtime >=']=$parameters['time']['begin'];
		// 	}
		// 	if(isset($parameters['time']['end'])){
		// 		$condition['where']['addtime <=']=$parameters['time']['end'];
		// 	}
		// }
		$score=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($essays as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $score;
	}
	public function getGpa($parameters){
		$condition=array(
			'table'=>'gpa',
			'result'=>$parameters['result']
		);
		// if(isset($parameters['draft'])){
		// 	$condition['where']=array('draft'=>$parameters['draft']);
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }else{
		// 	$condition['order_by']=array('order'=>'ASC');
		// }
		$students_parameters=array('result'=>'data');
		
		if(isset($parameters['student'])){
			if(is_numeric($parameters['student'])){
				$students_parameters['like_number']=$parameters['student'];
			}else{
				$students_parameters['like_name']=$parameters['student'];
			}
			// $students_parameters['student']=array('student'=>$parameters['student']);
		}
		if(isset($parameters['academy']) && $parameters['academy']!=-1){
			$students_parameters['academy']=$parameters['academy'];
		}
		if(isset($parameters['speciality']) && $parameters['speciality']!=-1){
			$students_parameters['speciality']=$parameters['speciality'];
		}
		if(isset($parameters['class']) && $parameters['class']!=-1){
			$students_parameters['class']=$parameters['class'];
		}
		// if(isset($parameters['gender'])){
		// 	$students_parameters['gender']=$parameters['gender'];
		// }
		if(isset($parameters['ispoor'])){
			$students_parameters['ispoor']=$parameters['ispoor'];
		}
		$students=$this->getStudents($students_parameters);

		// $courses_paremeters=array('result'=>'data');
		// if (isset($parameters['course'])) {
		// 	if(is_numeric($parameters['course'])){
		// 		$courses_paremeters['like_code']=$parameters['course'];
		// 	}else{
		// 		$courses_paremeters['like_name']=$parameters['course'];
		// 	}
		// }
		// $courses=$this->getCourses($courses_paremeters);

		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['speorder']) && is_numeric($parameters['speorder'])){
			$condition['where']['speorder']=$parameters['speorder'];
		}
		if(isset($parameters['gpalower']) && is_numeric($parameters['gpalower'])){
			$condition['where']['gpa >=']=$parameters['gpalower'];
		}
		if(isset($parameters['gpaupper']) && is_numeric($parameters['gpaupper'])){
			$condition['where']['gpa <=']=$parameters['gpaupper'];
		}
		if(sizeof($students_parameters)>1){
			if (sizeof($students)==0) {
				$condition['where_in']['stu_id']=array("0");
			}else{
				$students_id=array();
				foreach ($students as $value) {
					$students_id[]=$value->id;
				}
				$condition['where_in']['stu_id']=$students_id;
			}
		}
		// if(sizeof($courses_paremeters)>1){
		// 	if (sizeof($courses)==0) {
		// 		$condition['limit']=0;
		// 	}else{
		// 		$courses_id=array();
		// 		foreach ($courses as $value) {
		// 			$courses_id[]=$value->id;
		// 		}
		// 		$condition['where_in']['course']=$courses_id;
		// 	}
		// }
		// if (isset($parameters['range']) && $parameters['unpass']!=-1) {
		// 	$condition['where']['score <']=60;
		// 	$condition['group_by']='stu_id';
		// 	if ($parameters['unpass']==1) {
		// 		$condition['having']['count(0) =']=1;
		// 	}elseif ($parameters['unpass']==2) {
		// 		$condition['having']['coun(0) =']=2;
		// 	}elseif ($parameters['unpass']==3) {
		// 		$condition['having']['count(0) =']=3;
		// 	}elseif ($parameters['unpass']==4) {
		// 		$condition['having']['count(0) >=']=4;
		// 	}
		// }
		// if(isset($parameters['time'])){
		// 	if(isset($parameters['time']['begin'])){
		// 		$condition['where']['addtime >=']=$parameters['time']['begin'];
		// 	}
		// 	if(isset($parameters['time']['end'])){
		// 		$condition['where']['addtime <=']=$parameters['time']['end'];
		// 	}
		// }
		$score=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($essays as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $score;
	}
	public function getExpense($parameters){
		$condition=array(
			'table'=>'expense',
			'result'=>$parameters['result']
		);
		// if(isset($parameters['draft'])){
		// 	$condition['where']=array('draft'=>$parameters['draft']);
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }else{
		// 	$condition['order_by']=array('order'=>'ASC');
		// }
		$students_parameters=array('result'=>'data');
		
		if(isset($parameters['student'])){
			if(is_numeric($parameters['student'])){
				$students_parameters['like_number']=$parameters['student'];
			}else{
				$students_parameters['like_name']=$parameters['student'];
			}
			// $students_parameters['student']=array('student'=>$parameters['student']);
		}
		if(isset($parameters['academy']) && $parameters['academy']!=-1){
			$students_parameters['academy']=$parameters['academy'];
		}
		if(isset($parameters['speciality']) && $parameters['speciality']!=-1){
			$students_parameters['speciality']=$parameters['speciality'];
		}
		if(isset($parameters['class']) && $parameters['class']!=-1){
			$students_parameters['class']=$parameters['class'];
		}
		// if(isset($parameters['gender'])){
		// 	$students_parameters['gender']=$parameters['gender'];
		// }
		if(isset($parameters['ispoor'])){
			$students_parameters['ispoor']=$parameters['ispoor'];
		}
		$students=$this->getStudents($students_parameters);
		// $courses_paremeters=array('result'=>'data');
		// if (isset($parameters['course'])) {
		// 	if(is_numeric($parameters['course'])){
		// 		$courses_paremeters['like_code']=$parameters['course'];
		// 	}else{
		// 		$courses_paremeters['like_name']=$parameters['course'];
		// 	}
		// }
		// $courses=$this->getCourses($courses_paremeters);

		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['explower']) && is_numeric($parameters['explower'])){
			$condition['where']['money >=']=$parameters['explower'];
		}
		if(isset($parameters['expupper']) && is_numeric($parameters['expupper'])){
			$condition['where']['money <=']=$parameters['expupper'];
		}
		if(sizeof($students_parameters)>1){
			if (sizeof($students)==0) {
				$condition['where_in']['stu_id']=array("0");
			}else{
				$students_id=array();
				foreach ($students as $value) {
					$students_id[]=$value->id;
				}
				$condition['where_in']['stu_id']=$students_id;
			}
		}
		if (isset($parameters['exprank']) && $parameters['exprank']!=-1) {
			if ($parameters['exprank']==0) {
				$condition['order_by']=array('money'=>'DESC');
			}elseif ($parameters['exprank']==1) {
				$condition['order_by']=array('money'=>'ASC');
			}
			$condition['limit']=$parameters['limit'];
		}
		$expense=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($essays as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $expense;
	}
	public function getScholarship($parameters){
		$condition=array(
			'table'=>'scholarship',
			'result'=>$parameters['result']
		);
		// if(isset($parameters['draft'])){
		// 	$condition['where']=array('draft'=>$parameters['draft']);
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }else{
		// 	$condition['order_by']=array('order'=>'ASC');
		// }
		$students_parameters=array('result'=>'data');
		
		if(isset($parameters['student'])){
			if(is_numeric($parameters['student'])){
				$students_parameters['like_number']=$parameters['student'];
			}else{
				$students_parameters['like_name']=$parameters['student'];
			}
			// $students_parameters['student']=array('student'=>$parameters['student']);
		}
		if(isset($parameters['academy']) && $parameters['academy']!=-1){
			$students_parameters['direct_acamedy']=$parameters['academy'];
		}
		if(isset($parameters['speciality']) && $parameters['speciality']!=-1){
			$students_parameters['speciality']=$parameters['speciality'];
		}
		if(isset($parameters['class']) && $parameters['class']!=-1){
			$students_parameters['class']=$parameters['class'];
		}
		// if(isset($parameters['gender'])){
		// 	$students_parameters['gender']=$parameters['gender'];
		// }
		if(isset($parameters['ispoor'])){
			$students_parameters['ispoor']=$parameters['ispoor'];
		}
		$students=$this->getStudents($students_parameters);

		if(isset($parameters['scholarshiptype']) && $parameters['scholarshiptype']!=-1){
			switch ($parameters['scholarshiptype']) {
				case 0://思想品德奖学金
					$scholarshiptype="moral";
					break;
				case 1://学习奖学金
					$scholarshiptype="study";
					break;
				case 2://社会实践奖学金
					$scholarshiptype="practice";
					break;
				case 3://体育奖学金
					$scholarshiptype="sport";
					break;
				case 4://济困奖学金
					$scholarshiptype="jikun";
					break;
				case 5://纯济困奖学金
					$scholarshiptype="chunjikun";
					break;
				case 6://优秀学生奖学金
					$scholarshiptype="youxiu";
					break;
				default:
					# code...
					break;
			}
			if (isset($parameters['scholarshipgrade']) && $parameters['scholarshipgrade']!=-1) {
				switch ($parameters['scholarshipgrade']) {
					case 0:
						$condition['where'][$scholarshiptype]=1000;
						break;
					case 1:
						$condition['where'][$scholarshiptype]=800;
						break;
					case 2:
						$condition['where'][$scholarshiptype]=500;
						break;
					default:
						# code...
						break;
				}
			}else{
				$condition['where'][$scholarshiptype.' >']=0;
			}
			
		}elseif(isset($parameters['scholarshipgrade']) && $parameters['scholarshipgrade']!=-1){
			switch ($parameters['scholarshipgrade']) {
				case 0://一等奖
					$condition['or_where']['moral']=1000;
					$condition['or_where']['study']=1000;
					$condition['or_where']['practice']=1000;
					$condition['or_where']['sport']=1000;
					$condition['or_where']['jikun']=1000;
					$condition['or_where']['chunjikun']=1000;
					$condition['or_where']['youxiu']=1000;
					break;
				case 1://二等奖
					$condition['or_where']['moral']=800;
					$condition['or_where']['study']=800;
					$condition['or_where']['practice']=800;
					$condition['or_where']['sport']=800;
					$condition['or_where']['jikun']=800;
					$condition['or_where']['chunjikun']=800;
					$condition['or_where']['youxiu']=800;
					break;
				case 2://三等奖
					$condition['or_where']['moral']=500;
					$condition['or_where']['study']=500;
					$condition['or_where']['practice']=500;
					$condition['or_where']['sport']=500;
					$condition['or_where']['jikun']=500;
					$condition['or_where']['chunjikun']=500;
					$condition['or_where']['youxiu']=500;
					break;
				default:
					# code...
					break;
			}
			
		}
		if (isset($parameters['scholarshiptime']) && $parameters['scholarshiptime']!=-1) {
			$condition['group_by']='stu_id';
			if ($parameters['scholarshiptime']==1) {
				$condition['having']['count(0) =']=1;
			}elseif ($parameters['scholarshiptime']==2) {
				$condition['having']['coun(0) =']=2;
			}elseif ($parameters['scholarshiptime']==3) {
				$condition['having']['coun(0) =']=3;
			}elseif ($parameters['scholarshiptime']==4) {
				$condition['having']['coun(0) =']=4;
			}
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		// if(isset($parameters['speorder']) && is_numeric($parameters['speorder'])){
		// 	$condition['where']['speorder']=$parameters['speorder'];
		// }
		// if(isset($parameters['gpalower']) && is_numeric($parameters['gpalower'])){
		// 	$condition['where']['gpa >=']=$parameters['gpalower'];
		// }
		// if(isset($parameters['gpaupper']) && is_numeric($parameters['gpaupper'])){
		// 	$condition['where']['gpa <=']=$parameters['gpaupper'];
		// }
		if(sizeof($students_parameters)>1){
			if (sizeof($students)==0) {
				$condition['where_in']['stu_id']=array("0");
			}else{
				$students_id=array();
				foreach ($students as $value) {
					$students_id[]=$value->id;
				}
				$condition['where_in']['stu_id']=$students_id;
			}
		}
		$scholarship=$this->getData($condition);
		return $scholarship;
	}
	public function getAssistantship($parameters){
		$condition=array(
			'table'=>'assistantship',
			'result'=>$parameters['result']
		);
		// if(isset($parameters['draft'])){
		// 	$condition['where']=array('draft'=>$parameters['draft']);
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }else{
		// 	$condition['order_by']=array('order'=>'ASC');
		// }
		$students_parameters=array('result'=>'data');
		
		if(isset($parameters['student'])){
			if(is_numeric($parameters['student'])){
				$students_parameters['like_number']=$parameters['student'];
			}else{
				$students_parameters['like_name']=$parameters['student'];
			}
			// $students_parameters['student']=array('student'=>$parameters['student']);
		}
		if(isset($parameters['academy']) && $parameters['academy']!=-1){
			$students_parameters['direct_acamedy']=$parameters['academy'];
		}
		if(isset($parameters['speciality']) && $parameters['speciality']!=-1){
			$students_parameters['direct_speciality']=$parameters['speciality'];
		}
		// if(isset($parameters['class']) && $parameters['class']!=-1){
		// 	$students_parameters['class']=$parameters['class'];
		// }
		if(isset($parameters['gender'])){
			$students_parameters['gender']=$parameters['gender'];
		}
		$students=$this->getStudents($students_parameters);

		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(sizeof($students_parameters)>1){
			if (sizeof($students)==0) {
				$condition['where_in']['stu_id']=array("0");
			}else{
				$students_id=array();
				foreach ($students as $value) {
					$students_id[]=$value->id;
				}
				$condition['where_in']['stu_id']=$students_id;
			}
		}
		// if(isset($parameters['time'])){
		// 	if(isset($parameters['time']['begin'])){
		// 		$condition['where']['addtime >=']=$parameters['time']['begin'];
		// 	}
		// 	if(isset($parameters['time']['end'])){
		// 		$condition['where']['addtime <=']=$parameters['time']['end'];
		// 	}
		// }
		$assistantship=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($essays as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $assistantship;
	}
	public function getMotischolarship($parameters){
		$condition=array(
			'table'=>'motischolarship',
			'result'=>$parameters['result']
		);
		// if(isset($parameters['draft'])){
		// 	$condition['where']=array('draft'=>$parameters['draft']);
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }else{
		// 	$condition['order_by']=array('order'=>'ASC');
		// }
		$students_parameters=array('result'=>'data');
		
		if(isset($parameters['student'])){
			if(is_numeric($parameters['student'])){
				$students_parameters['like_number']=$parameters['student'];
			}else{
				$students_parameters['like_name']=$parameters['student'];
			}
			// $students_parameters['student']=array('student'=>$parameters['student']);
		}
		if(isset($parameters['academy']) && $parameters['academy']!=-1){
			$students_parameters['direct_acamedy']=$parameters['academy'];
		}
		if(isset($parameters['speciality']) && $parameters['speciality']!=-1){
			$students_parameters['direct_speciality']=$parameters['speciality'];
		}
		// if(isset($parameters['class']) && $parameters['class']!=-1){
		// 	$students_parameters['class']=$parameters['class'];
		// }
		if(isset($parameters['gender'])){
			$students_parameters['gender']=$parameters['gender'];
		}
		$students=$this->getStudents($students_parameters);

		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(sizeof($students_parameters)>1){
			if (sizeof($students)==0) {
				$condition['where_in']['stu_id']=array("0");
			}else{
				$students_id=array();
				foreach ($students as $value) {
					$students_id[]=$value->id;
				}
				$condition['where_in']['stu_id']=$students_id;
			}
		}
		// if(isset($parameters['time'])){
		// 	if(isset($parameters['time']['begin'])){
		// 		$condition['where']['addtime >=']=$parameters['time']['begin'];
		// 	}
		// 	if(isset($parameters['time']['end'])){
		// 		$condition['where']['addtime <=']=$parameters['time']['end'];
		// 	}
		// }
		$motischolarship=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($essays as $key => $value) {
		// 		$value->columnName=$this->getContent('column',$value->column)->name;
		// 	}
		// }
		return $motischolarship;
	}
	public function getStudents($parameters){
		$condition=array(
			'table'=>'student',
			'result'=>$parameters['result']
		);
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['class']) && $parameters['class']>0){
			$condition['where']['class']=$parameters['class'];
		}elseif (isset($parameters['speciality']) && $parameters['speciality']>0) {
			$classes=$this->getClasses(array('result'=>'data','speciality'=>$parameters['speciality']));
			$classes_id=array();
			foreach ($classes as $value) {
				$classes_id[]=$value->id;
			}
			if (sizeof($classes_id)==0) {
				$condition['where']['class']=0;
			}else{
				$condition['where_in']['class']=$classes_id;
			}
		}elseif (isset($parameters['academy']) && $parameters['academy']>0) {
			$specialities=$this->getSpecialities(array('result'=>'data','academy'=>$parameters['academy']));
			$specialities_id=array();
			foreach ($specialities as $value) {
				$specialities_id[]=$value->id;
			}
			$classes=$this->getClasses(array('result'=>'data','specialities'=>$specialities_id));
			$classes_id=array();
			foreach ($classes as $value) {
				$classes_id[]=$value->id;
			}
			if (sizeof($classes_id)==0) {
				$condition['where']['class']=0;
			}else{
				$condition['where_in']['class']=$classes_id;
			}
		}elseif (isset($parameters['direct_speciality']) && $parameters['direct_speciality']>0) {
			$condition['where']['speciality']=$parameters['direct_speciality'];
		}elseif (isset($parameters['direct_acamedy']) && $parameters['direct_acamedy']>0) {
			$condition['where']['acamedy']=$parameters['direct_acamedy'];
		}
		if (isset($parameters['ispoor']) && $parameters['ispoor']==0) {
			$condition['right_join']['assistantship']='student.id = assistantship.stu_id';
		}
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:intval($parameters['gender']);
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		// if(isset($parameters['keywords'])){
		// 	$condition['or_like_bracket']['alias']=$parameters['keywords'];
		// 	$condition['or_like_bracket']['phone']=$parameters['keywords'];
		// }
		if(isset($parameters['like_number'])){
			$condition['like']=array('number'=>$parameters['like_number']);
		}
		if(isset($parameters['like_name'])){
			$condition['like']=array('name'=>$parameters['like_name']);
		}
		// if(isset($parameters['time'])){
		// 	if(isset($parameters['time']['begin'])){
		// 		$condition['where']['addtime >=']=$parameters['time']['begin'];
		// 	}
		// 	if(isset($parameters['time']['end'])){
		// 		$condition['where']['addtime <=']=$parameters['time']['end'];
		// 	}
		// }
		$students=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($buyers as $key => $value) {
		// 		$value->supermarket=$this->getContent('supermarket',$value->defaultsid);
		// 	}
		// }
		return $students;
	}
	public function getCourses($parameters){
		$condition=array(
			'table'=>'course',
			'result'=>$parameters['result']
		);
		if(isset($parameters['code']) && is_numeric($parameters['code'])){
			$condition['where']['code']=$parameters['code'];
		}
		// if(isset($parameters['gender'])){
		// 	$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		// }
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }
		// if(isset($parameters['keywords'])){
		// 	$condition['or_like_bracket']['alias']=$parameters['keywords'];
		// 	$condition['or_like_bracket']['phone']=$parameters['keywords'];
		// }
		if(isset($parameters['like_code'])){
			$condition['like']=array('code'=>$parameters['like_code']);
		}
		if(isset($parameters['like_name'])){
			$condition['like']=array('name'=>$parameters['like_name']);
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		// if(isset($parameters['time'])){
		// 	if(isset($parameters['time']['begin'])){
		// 		$condition['where']['addtime >=']=$parameters['time']['begin'];
		// 	}
		// 	if(isset($parameters['time']['end'])){
		// 		$condition['where']['addtime <=']=$parameters['time']['end'];
		// 	}
		// }
		$courses=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($buyers as $key => $value) {
		// 		$value->supermarket=$this->getContent('supermarket',$value->defaultsid);
		// 	}
		// }
		return $courses;
	}
	public function getSpecialities($parameters){
		$condition=array(
			'table'=>'speciality',
			'result'=>$parameters['result']
		);
		if(isset($parameters['academy'])){
			$condition['where']['academy']=$parameters['academy'];
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
		$specialities=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($specialities as $key => $value) {
		// 		$value->supermarket=$this->getContent('supermarket',$value->defaultsid);
		// 	}
		// }
		return $specialities;
	}
	public function getClasses($parameters){
		$condition=array(
			'table'=>'class',
			'result'=>$parameters['result']
		);
		if(isset($parameters['speciality'])){
			$condition['where']['speciality']=$parameters['speciality'];
		}
		if (isset($parameters['specialities'])) {
			$condition['where_in']['speciality']=$parameters['specialities'];
		}
		// if(isset($parameters['orderBy'])){
		// 	$condition['order_by']=$parameters['orderBy'];
		// }
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['name']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		$classes=$this->getData($condition);
		// if($parameters['result']=='data'){
		// 	foreach ($classes as $key => $value) {
		// 		$value->supermarket=$this->getContent('supermarket',$value->defaultsid);
		// 	}
		// }
		return $classes;
	}

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