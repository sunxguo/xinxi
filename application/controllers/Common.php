<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Common extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("upload");
		$this->load->library('GetData');
		$this->load->library('PHPExcel/IOFactory',array());
		// $this->load->library('PHPExcel/PHPExcel_Cell',array());
		$this->load->model("dbHandler");
	}
	public function addInfo(){
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType){
			case "banner":
				$table="banner";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"title"=>$data->title,
					"introduction"=>$data->introduction,
					"addtime"=>$time,
					"edittime"=>$time,
					"content"=>$data->content,
					"thumbnail"=>strstr($data->thumbnail,'http')?$data->thumbnail:SERVER_IP.($data->thumbnail),
					"order"=>is_numeric($data->order)?$data->order:0,
					"draft"=>$data->draft
				);
			break;
			case "aboutus":
				$table="aboutus";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"appname"=>$data->appname,
					"addtime"=>$time,
					"edittime"=>$time,
					"content"=>$data->content,
					"logo"=>strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo),
					"version"=>$data->version,
					"role"=>$data->role
				);
			break;
			case "seller":
				$table="seller";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"sid"=>$data->sid,
					"name"=>$data->name,
					"addtime"=>$time,
					"edittime"=>$time,
					"workno"=>$data->workno,
					"gender"=>$data->gender,
					"phone"=>$data->phone,
					"password"=>md5($data->password."63"),
					"photo"=>$data->photo==""?'':(strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo)),
					"role"=>is_numeric($data->role)?$data->role:1,
					"token"=>md5(($data->phone).($data->password).time()),
					"status"=>$data->status
				);
			break;
			case "product":
				$table="goods";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"sid"=>$data->sid,
					"name"=>$data->name,
					"barcode"=>$data->barcode,
					"price"=>$data->price,
					"photo"=>strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo),
					"isedit"=>$data->isedit,
					"categoryid"=>$data->categoryid,
					"status"=>$data->status,
					"addtime"=>$time,
					"edittime"=>$time
				);
			break;
			case "category":
				$table="category";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"sid"=>$data->sid,
					"name"=>$data->name,
					"order"=>$data->order,
					"addtime"=>$time,
					"edittime"=>$time
				);
			break;
			case "supermarket":
				if($this->getdata->isExist('supermarket',array('no'=>$data->no,'type'=>0))){
					echo json_encode(array("result"=>"failed","message"=>"超市代码已经存在，请更换！"));
					return false;
				}
				if($this->getdata->isExist('supermarket',array('sno'=>$data->sno))){
					echo json_encode(array("result"=>"failed","message"=>"超市编号已经存在，请更换！"));
					return false;
				}
				$table="supermarket";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"no"=>$data->no,
					"sno"=>$data->sno,
					"name"=>$data->name,
					"type"=>0,
					"logo"=>strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo),
					"status"=>$data->status,
					"addtime"=>$time,
					"edittime"=>$time,
				);
			break;
			case "subsupermarket":
				if($this->getdata->isExist('supermarket',array('sno'=>$data->sno))){
					echo json_encode(array("result"=>"failed","message"=>"超市编号已经存在，请更换！"));
					return false;
				}
				$table="supermarket";
				$time=date("Y-m-d H:i:s");
				$supermarket=$this->getdata->getContent('supermarket',$data->supermarket);
				$info=array(
					"no"=>$supermarket->no,
					"sno"=>$data->sno,
					"name"=>$supermarket->name,
					"sname"=>$data->sname,
					"type"=>1,
					"province"=>$data->province,
					"city"=>$data->city,
					"area"=>$data->area,
					"detailedarea"=>$data->detailedarea,
					"logo"=>strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo),
					"lng"=>$data->lng,
					"lat"=>$data->lat,
					"status"=>$data->status,
					"addtime"=>$time,
					"edittime"=>$time
				);
			break;
			// case "essay":
			// 	$table="essay";
			// 	$info=array(
			// 		"column"=>$data->column,
			// 		"title"=>$data->title,
			// 		"islink"=>$data->islink,
			// 		"link"=>$data->link,
			// 		"summary"=>$data->summary,
			// 		"content"=>$data->content,
			// 		"thumbnail"=>$data->thumbnail,
			// 		"author"=>1,
			// 		"time"=>date("Y-m-d H:i:s")
			// 	);
			// 	if(isset($data->author)){
			// 		$info['author']=$data->author;
			// 	}
			// 	if(isset($data->avatar)){
			// 		$info['authorAvatar']=$data->avatar;
			// 	}
			// break;
			// case "user":
			// 	if($data->validcode!=$_SESSION['authcode']){
			// 		echo json_encode(array("result"=>"failed","message"=>"验证码错误！"));
			// 		return false;
			// 	}
			// 	$table='user';
			// 	$info=array(
			// 		"email"=>$data->email,
			// 		"password"=>md5('SXJY'.($data->password)),
			// 		"time"=>date("Y-m-d H:i:s")
			// 	);
		}
		$result=$this->dbHandler->insertData($table,$info);
		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}
	public function addBulkInfo(){
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType){
			case "coupons":
				$table="coupon";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"sid"=>$data->sid,
					"facevalue"=>$data->facevalue,
					"useprice"=>$data->useprice,
					"beginvalid"=>$data->beginvalid,
					"endvalid"=>$data->endvalid,
					"addtime"=>$time,
					"edittime"=>$time
				);
				$users=array();
				if($data->buyerid==0){
					$allUsers=$this->getdata->getBuyers(array('result'=>'data'));
					foreach ($allUsers as $key => $value) {
						$users[]=$value->id;
					}
				}else{
					$usersLinecode=explode(',',$data->buyerid);
					foreach ($usersLinecode as $value) {
						$user=$this->getdata->getContentAdvance('buyer',array('linecode'=>$value));
						if(isset($user->id)){
							$users[]=$user->id;
						}
					}
				}
				foreach ($users as $value) {
					$info['buyerid']=$value;
					$this->dbHandler->insertData($table,$info);
				}
				if($data->pushmsg=='1'){
					$pushUrl='http://182.92.156.106:9080/CDB/buyer/sendcoupons';
					$ids=implode(',',$users);
					httpPost($pushUrl,array('ids'=>$ids));
				}
			break;
		}
		echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
	}
	public function modifyInfo(){
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		$where=array();
		switch($data->infoType){
			// case "banner":
			// 	$table="banner";
			// 	$where=array('id'=>$data->id);
			// 	$info=array('edittime'=>date("Y-m-d H:i:s"));
			// 	if(isset($data->title)){
			// 		$info['title']=$data->title;
			// 	}
			// 	if(isset($data->introduction)){
			// 		$info['introduction']=$data->introduction;
			// 	}
			// 	if(isset($data->content)){
			// 		$info['content']=$data->content;
			// 	}
			// 	if(isset($data->thumbnail)){
			// 		$info['thumbnail']=strstr($data->thumbnail,'http')?$data->thumbnail:SERVER_IP.($data->thumbnail);
			// 	}
			// 	if(isset($data->order)){
			// 		$info['order']=$data->order;
			// 	}
			// 	if(isset($data->draft)){
			// 		$info['draft']=$data->draft;
			// 	}

			// break;
			// case "aboutus":
			// 	$table="aboutus";
			// 	$where=array('id'=>$data->id);
			// 	$info=array('edittime'=>date("Y-m-d H:i:s"));
			// 	if(isset($data->role)){
			// 		$info['role']=$data->role;
			// 	}
			// 	if(isset($data->content)){
			// 		$info['content']=$data->content;
			// 	}
			// 	if(isset($data->logo)){
			// 		$info['logo']=strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo);
			// 	}
			// 	if(isset($data->appname)){
			// 		$info['appname']=$data->appname;
			// 	}
			// 	if(isset($data->version)){
			// 		$info['version']=$data->version;
			// 	}
			// break;
			// case "buyer":
			// 	$table="buyer";
			// 	$where=array('id'=>$data->id);
			// 	$info=array('edittime'=>date("Y-m-d H:i:s"));
			// 	if(isset($data->alias)){
			// 		$info['alias']=$data->alias;
			// 	}
			// 	if(isset($data->gender)){
			// 		$info['gender']=$data->gender;
			// 	}
			// 	if(isset($data->photo)){
			// 		$info['photo']=strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo);
			// 	}
			// 	if(isset($data->birthdate)){
			// 		$info['birthdate']=$data->birthdate;
			// 	}
			// 	if(isset($data->phone)){
			// 		$info['phone']=$data->phone;
			// 	}
			// 	if(isset($data->status)){
			// 		$info['status']=$data->status;
			// 	}

			// break;
			// case "seller":
			// 	$table="seller";
			// 	$where=array('id'=>$data->id);
			// 	$info=array('edittime'=>date("Y-m-d H:i:s"));
			// 	if(isset($data->sid)){
			// 		$info['sid']=$data->sid;
			// 	}
			// 	if(isset($data->name)){
			// 		$info['name']=$data->name;
			// 	}
			// 	if(isset($data->gender)){
			// 		$info['gender']=$data->gender;
			// 	}
			// 	if(isset($data->photo)){
			// 		$info['photo']=$data->photo==""?'':(strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo));
			// 	}
			// 	if(isset($data->workno)){
			// 		$info['workno']=$data->workno;
			// 	}
			// 	if(isset($data->role)){
			// 		$info['role']=$data->role;
			// 	}
			// 	if(isset($data->phone)){
			// 		$info['phone']=$data->phone;
			// 	}
			// 	if(isset($data->password)){
			// 		$info['password']=md5($data->password."63");
			// 	}
			// 	if(isset($data->status)){
			// 		$info['status']=$data->status;
			// 	}

			// break;
			// case "supermarket":
			// 	$table="supermarket";
			// 	$where=array('id'=>$data->id);
			// 	$info=array('edittime'=>date("Y-m-d H:i:s"));
			// 	if(isset($data->no)){
			// 		if($this->getdata->isModifyExist('supermarket',$data->id,array('no'=>$data->no,'type'=>0))){
			// 			echo json_encode(array("result"=>"failed","message"=>"超市代码已经存在，请更换！"));
			// 			return false;
			// 		}
			// 		$info['no']=$data->no;
			// 	}
			// 	if(isset($data->sno)){
			// 		if($this->getdata->isModifyExist('supermarket',$data->id,array('sno'=>$data->sno))){
			// 			echo json_encode(array("result"=>"failed","message"=>"超市编号已经存在，请更换！"));
			// 			return false;
			// 		}
			// 		$info['sno']=$data->sno;
			// 	}
			// 	if(isset($data->name)){
			// 		$info['name']=$data->name;
			// 	}
			// 	if(isset($data->sname)){
			// 		$info['sname']=$data->sname;
			// 	}
			// 	if(isset($data->province)){
			// 		$info['province']=$data->province;
			// 	}
			// 	if(isset($data->city)){
			// 		$info['city']=$data->city;
			// 	}
			// 	if(isset($data->area)){
			// 		$info['area']=$data->area;
			// 	}
			// 	if(isset($data->detailedarea)){
			// 		$info['detailedarea']=$data->detailedarea;
			// 	}
			// 	if(isset($data->logo)){
			// 		$info['logo']=strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo);
			// 	}
			// 	if(isset($data->lng)){
			// 		$info['lng']=$data->lng;
			// 	}
			// 	if(isset($data->lat)){
			// 		$info['lat']=$data->lat;
			// 	}
			// 	if(isset($data->status)){
			// 		$info['status']=$data->status;
			// 	}
			// break;
			case "upass":
				$table="upass";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->score_ordinary)){
					$info['score_ordinary']=$data->score_ordinary;
				}
				if(isset($data->score_term)){
					$info['score_term']=$data->score_term;
				}
				if(isset($data->score)){
					$info['score']=$data->score;
				}
				// if($this->getdata->isModifyExist('student',$data->student->id,array('number'=>$data->student->number))){
				// 	echo json_encode(array("result"=>"failed","message"=>"学生学号已经存在，请更换！"));
				// 	return false;
				// }elseif($this->getdata->isExist('student',array('number'=>$data->student->number))){
				// 	//修改学生信息
				// 	$result=$this->dbHandler->insertData('student',array('number'));
				// 	$info['stu_id']=$data->student->id;
				// }else{
				// 	//添加学生信息
				// }
			break;
			case "score":
				$table="score";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->score_ordinary)){
					$info['score_ordinary']=$data->score_ordinary;
				}
				if(isset($data->score_term)){
					$info['score_term']=$data->score_term;
				}
				if(isset($data->score)){
					$info['score']=$data->score;
				}
				//修改学生信息
				$result=$this->dbHandler->updateData(
					array(
						'table'=>"student",
						'where'=>array("id"=>$data->student->id),
						'data'=>array(
							"number"=>$data->student->number,
							"name"=>$data->student->name,
							"gender"=>$data->student->gender
						)
					)
				);
			break;

			// case "category":
			// 	$table="category";
			// 	$where=array('id'=>$data->id);
			// 	$info=array('edittime'=>date("Y-m-d H:i:s"));
			// 	if(isset($data->sid)){
			// 		$info['sid']=$data->sid;
			// 	}
			// 	if(isset($data->name)){
			// 		$info['name']=$data->name;
			// 	}
			// 	if(isset($data->order)){
			// 		$info['order']=$data->order;
			// 	}
			// break;
			// case "essay":
			// 	$table="essay";
			// 	$where=array('id'=>$data->id);
			// 	$info=array(
			// 		"column"=>$data->column,
			// 		"title"=>$data->title,
			// 		"summary"=>$data->summary,
			// 		"islink"=>$data->islink,
			// 		"link"=>$data->link,
			// 		"content"=>$data->content,
			// 		"thumbnail"=>$data->thumbnail,
			// 		"time"=>date("Y-m-d H:i:s")
			// 	);
			// 	if(isset($data->author)){
			// 		$info['author']=$data->author;
			// 	}
			// 	if(isset($data->avatar)){
			// 		$info['authorAvatar']=$data->avatar;
			// 	}
			// break;
		}
		$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
	}
	public function deleteInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType){
			case 'upass':
				$condition['table']="upass";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'score':
				$condition['table']="score";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'gpa':
				$condition['table']="gpa";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'assistantship':
				$condition['table']="assistantship";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'scholarship':
				$condition['table']="scholarship";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'motischolarship':
				$condition['table']="motischolarship";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'expense':
				$condition['table']="expense";
				$condition['where']=array("id"=>$data->id);
			break;
		}
		$result=$this->dbHandler->deleteData($condition);
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息删除失败"));
	}
	public function deleteBulkInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType){
			case 'upasses':
				$table="upass";
				$where="id";
			break;
			case 'scores':
				$table="score";
				$where="id";
			break;
			case 'gpas':
				$table="gpa";
				$where="id";
			break;
			case 'assistantships':
				$table="assistantship";
				$where="id";
			break;
			case 'scholarships':
				$table="scholarship";
				$where="id";
			break;
			case 'expenses':
				$table="expense";
				$where="id";
			break;
		}
		foreach ($data->idArray as $value) {
			$result=$this->dbHandler->deleteData(array('table'=>$table,'where'=>array($where=>$value)));
		}
		echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
	}
	public function getInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		$result=array();
		switch($data->infoType){
			// case 'essay':
			// 	$result=$this->getdata->getContent('essay',$data->id);
			// break;
			// case 'login':
			// 	if(property_exists($data, "email") && property_exists($data, "password")){
			// 		$email=$data->email;
			// 		$password=$data->password;
			// 		$info=$this->getdata->getContentAdvance('user',array('email'=>$email));
			// 		if(property_exists($info,'email')){
			// 			$post_pwd=MD5("SXJY".$password);
			// 			$db_pwd=$info->password;
			// 			if($post_pwd==$db_pwd){
			// 				$_SESSION['useremail']=$info->email;
			// 				$_SESSION['userid']=$info->id;
			// 				$_SESSION['usertype']="user";
			// 				echo json_encode(array("result"=>"success","message"=>"登录成功!"));
			// 				return false;
			// 			}
			// 			else{
			// 				echo json_encode(array("result"=>"failed","message"=>"密码错误!"));
			// 				return false;
			// 			}
			// 		}
			// 		else{
			// 			echo json_encode(array("result"=>"failed","message"=>"用户名不存在!"));
			// 			return false;
			// 		}
			// 	}else{
			// 		echo json_encode(array("result"=>"failed","message"=>"请输入用户名和密码!"));
			// 		return false;
			// 	}
			// break;
			case 'logout':
				unset($_SESSION["useremail"]);
				unset($_SESSION["userid"]);
				unset($_SESSION["usertype"]);
				$result='成功退出！';
			break;
			case 'subSupermarkets':
				$result=$this->getdata->getSubSupermarkets($data->id);
			break;
			case 'supermarket':
				$result=$this->getdata->getContent('supermarket',$data->id);
			break;
			case 'categories':
				$result=$this->getdata->getCategories(
					array(
						'result'=>'data',
						'sid'=>$data->id,
						'orderBy'=>array('order'=>'ASC')
					)
				);
			break;
			case 'specialities':
				$condition=array(
					'result'=>'data'
					);
				if($data->id!=-1) $condition['academy']=$data->id;
				$result=$this->getdata->getSpecialities($condition);
				break;
			case 'classes':
				$condition=array(
					'result'=>'data'
					);
				if($data->id!=-1) $condition['speciality']=$data->id;
				$result=$this->getdata->getClasses($condition);
				break;
		}
		echo json_encode(array("result"=>"success","message"=>$result));
	}
	public function read($filename,$encode='utf-8'){
		$objReader = IOFactory::createReader('Excel2007');
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($filename);
		// $objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet = $objPHPExcel->getSheet(0);
		$highestRow = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		$excelData = array();
		for ($row = 1; $row <= $highestRow; $row++) {
			for ($col = 0; $col < $highestColumnIndex; $col++) {
				$excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();//getValue
			}
		}
		// print_r($excelData);
		return $excelData;
	}    
	public function uploadInfo(){
		$data=json_decode($_POST['data']);
		$result=array();
		switch($_POST['infoType']){
			case 'upass':
				$websiteUrl=$this->getdata->getWebsiteConfig('website_url');
				if(!fopen($_SERVER['DOCUMENT_ROOT'].$data->src,'r')){
					echo json_encode(array("result"=>"failed","message"=>"文件读取失败，请检查文件是否存在问题！"));
					break 2;
				}
				$itemList=array();
				// $head=fgetcsv($file);
				$dt=$this->read($_SERVER['DOCUMENT_ROOT'].$data->src,$encode='utf-8');
				// print_r($data);
				for ($row=2;$row<=sizeof($dt);$row++) { //每次读取CSV里面的一行内容
					// print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
					// $info=array(
					// 	"name"=>$data[0]
					// 	"product_merchant"=>$_SESSION['merchant_userid'],
					// 	"time"=>date("Y-m-d H:i:s")
					// );
					$data=$dt[$row];
					// print_r($data);

					//添加学院
					$table="academy";
					$info=array(
						"name"=>$data[1]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$data[1]
						);
						$academyId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$academyId=$result[0]->id;
					}

					//添加专业
					$table="speciality";
					$info=array(
						"academy"=>$academyId,
						"name"=>$data[6]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"academy"=>$academyId,
							"name"=>$data[6],
							"length"=>$data[7]
						);
						$specialityId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$specialityId=$result[0]->id;
					}

					//添加班级
					$table="class";
					$info=array(
						"name"=>$data[2],
						"speciality"=>$specialityId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					// print_r($result);
					if(sizeof($result)==0){
						$classId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$classId=$result[0]->id;
					}
					//添加学生
					$table="student";
					$info=array(
						"number"=>$data[3]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"class"=>$classId,
							"number"=>$data[3],
							"name"=>$data[4],
							"gender"=>$data[5]=="男"?0:1,
							"address"=>$data[8],
							"nation"=>$data[9],
							"property"=>$data[10]
						);
						$studentId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$studentId=$result[0]->id;
					}
					//添加课程
					$table="course";
					$info=array(
						"code"=>$data[11]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"code"=>$data[11],
							"name"=>$data[12]
						);
						$courseId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$courseId=$result[0]->id;
					}
					//添加学期
					$table="semester";
					$info=array(
						"name"=>$data[18]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$data[18]
						);
						$semesterId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$semesterId=$result[0]->id;
					}
					//添加挂科信息
					$table="upass";
					$info=array(
						"stu_id"=>$studentId,
						"course"=>$classId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"stu_id"=>$studentId,
							"semester"=>$semesterId,
							"course"=>$courseId,
							"score_ordinary"=>$data[14],
							"score_term"=>$data[15],
							"score"=>$data[16],
							"bigclass"=>$data[13],
							"examproperty"=>$data[17]
						);
						$upassId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$upassId=$result[0]->id;
					}
				 }
				 // fclose($file);
			break;
			case 'score':
				$websiteUrl=$this->getdata->getWebsiteConfig('website_url');
				// $file = fopen($websiteUrl.$data->src,'r'); 
				$itemList=array();
				// $head=fgetcsv($file);
				$dt=$this->read($_SERVER['DOCUMENT_ROOT'].$data->src,$encode='utf-8');
				// print_r($data);
				for ($row=5;$row<=sizeof($dt);$row++) { //每次读取CSV里面的一行内容
					// print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
					// $info=array(
					// 	"name"=>$data[0]
					// 	"product_merchant"=>$_SESSION['merchant_userid'],
					// 	"time"=>date("Y-m-d H:i:s")
					// );
					$data=$dt[$row];
					// print_r($data);

					//添加学院
					$table="academy";
					$info=array(
						"name"=>$data[0]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$data[0]
						);
						$academyId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$academyId=$result[0]->id;
					}

					//添加专业
					$table="speciality";
					$info=array(
						"academy"=>$academyId,
						"name"=>$data[5]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"academy"=>$academyId,
							"name"=>$data[5],
							"length"=>$data[6]
						);
						$specialityId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$specialityId=$result[0]->id;
					}

					//添加班级
					$table="class";
					$info=array(
						"name"=>$data[1],
						"speciality"=>$specialityId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					// print_r($result);
					if(sizeof($result)==0){
						$classId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$classId=$result[0]->id;
					}
					//添加学生
					$table="student";
					$info=array(
						"number"=>$data[2]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"class"=>$classId,
							"number"=>$data[2],
							"name"=>$data[3],
							"gender"=>$data[4]=="男"?0:1,
							"address"=>$data[7],
							"nation"=>$data[8],
							"property"=>$data[9]
						);
						$studentId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$studentId=$result[0]->id;
						$info=array(
							"class"=>$classId,
							"name"=>$data[3],
							"gender"=>$data[4]=="男"?0:1,
							"address"=>$data[7],
							"nation"=>$data[8],
							"property"=>$data[9]
						);
						$updateResult=$this->dbHandler->updateData(
							array(
								'table'=>"student",
								'where'=>array("id"=>$studentId),
								'data'=>$info
							)
						);
					}
					//添加课程
					$table="course";
					$info=array(
						"code"=>$data[10]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"code"=>$data[10],
							"name"=>$data[11]
						);
						$courseId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$courseId=$result[0]->id;
					}
					//添加学期
					$table="semester";
					$info=array(
						"name"=>$data[18]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$data[18]
						);
						$semesterId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$semesterId=$result[0]->id;
					}
					//添加挂科信息
					$table="score";
					$info=array(
						"stu_id"=>$studentId,
						"course"=>$classId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$time=date("Y-m-d H:i:s");
						$info=array(
							"stu_id"=>$studentId,
							"semester"=>$semesterId,
							"course"=>$courseId,
							"score_ordinary"=>$data[13],
							"score_term"=>$data[14],
							"score"=>$data[15],
							"bigclass"=>$data[12],
							"credit"=>$data[16],
							"examproperty"=>$data[17],
							"addtime"=>$time,
							"edittime"=>$time
						);
						$upassId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$upassId=$result[0]->id;
					}
				 }
				 // fclose($file);
			break;
			case 'gpa':
				// $websiteUrl=$this->getdata->getWebsiteConfig('website_url');
				// $file = fopen($websiteUrl.$data->src,'r'); 
				// $itemList=array();
				// $head=fgetcsv($file);
				if (property_exists($data, 'date') && $data->date!="") {
					$date=$data->date;
				}else{
					echo json_encode(array("result"=>"failed","message"=>"数据时间不能为空！"));
					return;
				}
				$dt=$this->read($_SERVER['DOCUMENT_ROOT'].$data->src,$encode='utf-8');
				// print_r($data);
				for ($row=5;$row<=sizeof($dt);$row++) { //每次读取CSV里面的一行内容
					// print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
					// $info=array(
					// 	"name"=>$data[0]
					// 	"product_merchant"=>$_SESSION['merchant_userid'],
					// 	"time"=>date("Y-m-d H:i:s")
					// );
					$data=$dt[$row];
					// print_r($data);

					//添加学院
					$table="academy";
					$info=array(
						"name"=>$data[0]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$data[0]
						);
						$academyId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$academyId=$result[0]->id;
					}

					//添加专业
					$table="speciality";
					$info=array(
						"academy"=>$academyId,
						"name"=>$data[2]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"academy"=>$academyId,
							"name"=>$data[2]
							// "length"=>$data[6]
						);
						$specialityId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$specialityId=$result[0]->id;
					}

					//添加班级
					$table="class";
					$info=array(
						"name"=>$data[4],
						"speciality"=>$specialityId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					// print_r($result);
					if(sizeof($result)==0){
						$classId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$classId=$result[0]->id;
					}
					//添加学生
					$table="student";
					$info=array(
						"number"=>$data[5]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"class"=>$classId,
							"number"=>$data[5],
							"name"=>$data[6],
							"grade"=>$data[1]
							// "gender"=>$data[4]=="男"?0:1,
							// "address"=>$data[7],
							// "nation"=>$data[8],
							// "property"=>$data[9]
						);
						$studentId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$studentId=$result[0]->id;
						$info=array(
							"class"=>$classId,
							"name"=>$data[6]
						);
						$updateResult=$this->dbHandler->updateData(
							array(
								'table'=>"student",
								'where'=>array("id"=>$studentId),
								'data'=>$info
							)
						);
					}
					
					//添加gpa信息
					$table="gpa";
					$info=array(
						"stu_id"=>$studentId,
						"date"=>$date
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$time=date("Y-m-d H:i:s");
						$info=array(
							"stu_id"=>$studentId,
							"date"=>$date,
							"amountinschool"=>$data[3],
							"allgradepoint"=>$data[7],
							"allscore"=>$data[8],
							"gpa"=>$data[9],
							"unpass"=>$data[10],
							"unpassnumber"=>$data[11],
							"speorder"=>$data[12],
							"order"=>$data[13],
							"addtime"=>$time,
							"edittime"=>$time
						);
						$affected_rows=$this->dbHandler->insertData($table,$info);
					}
					// else{
					// 	$gpaId=$result[0]->id;
					// }
				 }
				 // fclose($file);
			break;
			case 'assistantship':
				// $websiteUrl=$this->getdata->getWebsiteConfig('website_url');
				// $file = fopen($websiteUrl.$data->src,'r'); 
				// $itemList=array();
				// $head=fgetcsv($file);
				if (property_exists($data, 'date') && $data->date!="") {
					$date=$data->date;
				}else{
					echo json_encode(array("result"=>"failed","message"=>"数据时间不能为空！"));
					return;
				}
				$dt=$this->read($_SERVER['DOCUMENT_ROOT'].$data->src,$encode='utf-8');
				for ($row=3;$row<=sizeof($dt);$row++) { //每次读取CSV里面的一行内容
					// print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
					// $info=array(
					// 	"name"=>$data[0]
					// 	"product_merchant"=>$_SESSION['merchant_userid'],
					// 	"time"=>date("Y-m-d H:i:s")
					// );
					$data=$dt[$row];
					// print_r($data);

					//添加学院
					$table="academy";
					$info=array(
						"name"=>$data[3]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$data[3]
						);
						$academyId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$academyId=$result[0]->id;
					}

					//添加专业
					$table="speciality";
					$info=array(
						"academy"=>$academyId,
						"name"=>$data[4]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"academy"=>$academyId,
							"name"=>$data[4],
							// "length"=>$data[6]
						);
						$specialityId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$specialityId=$result[0]->id;
					}

					//添加班级
					// $table="class";
					// $info=array(
					// 	"name"=>$data[1],
					// 	"speciality"=>$specialityId
					// );
					// $result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					// // print_r($result);
					// if(sizeof($result)==0){
					// 	$classId=$this->dbHandler->insertDataReturnId($table,$info);
					// }else{
					// 	$classId=$result[0]->id;
					// }
					//添加学生
					$table="student";
					$info=array(
						"number"=>$data[5]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							// "class"=>$classId,
							"number"=>$data[5],
							"idnumber"=>$data[2],
							"name"=>$data[1],
							"gender"=>$data[6]=="男"?0:1,
							// "address"=>$data[7],
							"nation"=>$data[7],
							"enrolTime"=>$data[8],
							"minlivingstandard"=>$data[9]=="否"?0:1,
							"propertyofcensusregister"=>$data[10]=="农村"?0:1,
							"acamedy"=>$academyId,
							"speciality"=>$specialityId
						);
						$studentId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$studentId=$result[0]->id;
						$info=array(
							"idnumber"=>$data[2],
							"name"=>$data[1],
							"gender"=>$data[6]=="男"?0:1,
							// "address"=>$data[7],
							"nation"=>$data[7],
							"enrolTime"=>$data[8],
							"minlivingstandard"=>$data[9]=="否"?0:1,
							"propertyofcensusregister"=>$data[10]=="农村"?0:1,
							"acamedy"=>$academyId,
							"speciality"=>$specialityId
						);
						$updateResult=$this->dbHandler->updateData(
							array(
								'table'=>"student",
								'where'=>array("id"=>$studentId),
								'data'=>$info
							)
						);
					}
					//添加助学金信息
					$table="assistantship";
					$info=array(
						"date"=>$date,
						"stu_id"=>$studentId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						// $time=date("Y-m-d H:i:s");
						$info=array(
							"stu_id"=>$studentId,
							"date"=>$date,
							"ass_grade"=>$data[11]
						);
						$assistantshipId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$assistantshipId=$result[0]->id;
					}
				 }
				 // fclose($file);
			break;
			case 'scholarship':
				// $websiteUrl=$this->getdata->getWebsiteConfig('website_url');
				// $file = fopen($websiteUrl.$data->src,'r'); 
				// $itemList=array();
				// $head=fgetcsv($file);
				if (property_exists($data, 'date') && $data->date!="") {
					$date=$data->date;
				}else{
					echo json_encode(array("result"=>"failed","message"=>"数据时间不能为空！"));
					return;
				}
				if (property_exists($data, 'academy') && $data->academy!="") {
					$academy=$data->academy;
				}else{
					echo json_encode(array("result"=>"failed","message"=>"学院不能为空！"));
					return;
				}
				$dt=$this->read($_SERVER['DOCUMENT_ROOT'].$data->src,$encode='utf-8');
				for ($row=3;$row<=sizeof($dt);$row++) { //每次读取CSV里面的一行内容
					// print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
					// $info=array(
					// 	"name"=>$data[0]
					// 	"product_merchant"=>$_SESSION['merchant_userid'],
					// 	"time"=>date("Y-m-d H:i:s")
					// );
					$data=$dt[$row];
					// print_r($data);

					//添加学院
					$table="academy";
					$info=array(
						"name"=>$academy
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$academy
						);
						$academyId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$academyId=$result[0]->id;
					}

					//添加专业
					// $table="speciality";
					// $info=array(
					// 	"academy"=>$academyId,
					// 	"name"=>$data[4]
					// );
					// $result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					// if(sizeof($result)==0){
					// 	$info=array(
					// 		"academy"=>$academyId,
					// 		"name"=>$data[4],
					// 		// "length"=>$data[6]
					// 	);
					// 	$specialityId=$this->dbHandler->insertDataReturnId($table,$info);
					// }else{
					// 	$specialityId=$result[0]->id;
					// }

					//添加班级
					$table="class";
					$info=array(
						"name"=>$data[2]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					// print_r($result);
					if(sizeof($result)==0){
						$classId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$classId=$result[0]->id;
					}
					//添加学生
					$table="student";
					$info=array(
						"number"=>$data[3]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							// "class"=>$classId,
							"number"=>$data[3],
							// "idnumber"=>$data[2],
							"name"=>$data[1],
							// "gender"=>$data[6]=="男"?0:1,
							// "address"=>$data[7],
							// "nation"=>$data[7],
							// "enrolTime"=>$data[8],
							"isshuangpeisheng"=>$data[15]=="是"?1:0,
							"acamedy"=>$academyId,
							"class"=>$classId
						);
						$studentId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$studentId=$result[0]->id;
						$info=array(
							// "idnumber"=>$data[2],
							"name"=>$data[1],
							// "gender"=>$data[6]=="男"?0:1,
							// "address"=>$data[7],
							// "nation"=>$data[7],
							// "enrolTime"=>$data[8],
							"isshuangpeisheng"=>$data[15]=="是"?1:0,
							"acamedy"=>$academyId,
							"class"=>$classId
						);
						$updateResult=$this->dbHandler->updateData(
							array(
								'table'=>"student",
								'where'=>array("id"=>$studentId),
								'data'=>$info
							)
						);
					}
					//添加奖学金信息
					$table="scholarship";
					$info=array(
						"date"=>$date,
						"stu_id"=>$studentId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						// $time=date("Y-m-d H:i:s");
						$info=array(
							"stu_id"=>$studentId,
							"date"=>$date,
							"isnationass"=>$data[4]=="是"?1:0,
							"moral"=>$data[5],
							"study"=>$data[6],
							"practice"=>$data[7],
							"sport"=>$data[8],
							"jikun"=>$data[9],
							"chunjikun"=>$data[10],
							"youxiu"=>$data[11],
							"total"=>$data[12],
							"sportnote"=>$data[13],
							"practicenote"=>$data[14]
						);
						$result=$this->dbHandler->insertData($table,$info);
					}
				 }
				 // fclose($file);
			break;
			case 'motischolarship':
				// $websiteUrl=$this->getdata->getWebsiteConfig('website_url');
				// $file = fopen($websiteUrl.$data->src,'r'); 
				// $itemList=array();
				// $head=fgetcsv($file);
				if (property_exists($data, 'date') && $data->date!="") {
					$date=$data->date;
				}else{
					echo json_encode(array("result"=>"failed","message"=>"数据时间不能为空！"));
					return;
				}
				$dt=$this->read($_SERVER['DOCUMENT_ROOT'].$data->src,$encode='utf-8');
				for ($row=3;$row<=sizeof($dt);$row++) { //每次读取CSV里面的一行内容
					// print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
					// $info=array(
					// 	"name"=>$data[0]
					// 	"product_merchant"=>$_SESSION['merchant_userid'],
					// 	"time"=>date("Y-m-d H:i:s")
					// );
					$data=$dt[$row];
					// print_r($data);

					//添加学院
					$table="academy";
					$info=array(
						"name"=>$data[3]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"name"=>$data[3]
						);
						$academyId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$academyId=$result[0]->id;
					}

					//添加专业
					$table="speciality";
					$info=array(
						"academy"=>$academyId,
						"name"=>$data[4]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"academy"=>$academyId,
							"name"=>$data[4],
							// "length"=>$data[6]
						);
						$specialityId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$specialityId=$result[0]->id;
					}

					// //添加班级
					// $table="class";
					// $info=array(
					// 	"name"=>$data[2]
					// );
					// $result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					// // print_r($result);
					// if(sizeof($result)==0){
					// 	$classId=$this->dbHandler->insertDataReturnId($table,$info);
					// }else{
					// 	$classId=$result[0]->id;
					// }
					//添加学生
					$table="student";
					$info=array(
						"number"=>$data[5]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							// "class"=>$classId,
							"number"=>$data[5],
							"idnumber"=>$data[2],
							"name"=>$data[1],
							"gender"=>$data[6]=="男"?0:1,
							// "address"=>$data[7],
							"nation"=>$data[7],
							"enrolTime"=>$data[8],
							// "isshuangpeisheng"=>$data[15]=="是"?1:0,
							"acamedy"=>$academyId,
							"speciality"=>$specialityId
						);
						$studentId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$studentId=$result[0]->id;
						$info=array(
							"idnumber"=>$data[2],
							"name"=>$data[1],
							"gender"=>$data[6]=="男"?0:1,
							// "address"=>$data[7],
							"nation"=>$data[7],
							"enrolTime"=>$data[8],
							// "isshuangpeisheng"=>$data[15]=="是"?1:0,
							"acamedy"=>$academyId,
							"speciality"=>$specialityId
						);
						$updateResult=$this->dbHandler->updateData(
							array(
								'table'=>"student",
								'where'=>array("id"=>$studentId),
								'data'=>$info
							)
						);
					}
					//添加励志奖学金信息
					$table="motischolarship";
					$info=array(
						"date"=>$date,
						"stu_id"=>$studentId
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						// $time=date("Y-m-d H:i:s");
						$info=array(
							"stu_id"=>$studentId,
							"date"=>$date
						);
						$result=$this->dbHandler->insertData($table,$info);
					}
				 }
				 // fclose($file);
			break;
			case 'expense':
				// $websiteUrl=$this->getdata->getWebsiteConfig('website_url');
				// $file = fopen($websiteUrl.$data->src,'r'); 
				// $itemList=array();
				// $head=fgetcsv($file);
				if (property_exists($data, 'date') && $data->date!="") {
					$date=$data->date;
				}else{
					echo json_encode(array("result"=>"failed","message"=>"数据时间不能为空！"));
					return;
				}
				$dt=$this->read($_SERVER['DOCUMENT_ROOT'].$data->src,$encode='utf-8');
				for ($row=2;$row<=sizeof($dt);$row++) { //每次读取CSV里面的一行内容
					$data=$dt[$row];
					//添加学生
					$table="student";
					$info=array(
						"number"=>$data[0]
					);
					$result=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($result)==0){
						$info=array(
							"number"=>$data[0]
						);
						$studentId=$this->dbHandler->insertDataReturnId($table,$info);
					}else{
						$studentId=$result[0]->id;
					}
					//添加消费信息
					$table="expense";
					$info=array(
						"date"=>$date,
						"stu_id"=>$studentId
					);
					$expensedata=$this->getdata->getData(array('table'=>$table,'where'=>$info,'result'=>'data'));
					if(sizeof($expensedata)==0){
						// $time=date("Y-m-d H:i:s");
						$info=array(
							"stu_id"=>$studentId,
							"date"=>$date,
							"money"=>$data[1]
						);
						$result=$this->dbHandler->insertData($table,$info);
					}else{
						$expenseId=$expensedata[0]->id;
						$info=array(
							"money"=>$data[1]
						);
						$updateResult=$this->dbHandler->updateData(
							array(
								'table'=>"expense",
								'where'=>array("id"=>$expenseId),
								'data'=>$info
							)
						);
					}
				 }
				 // fclose($file);
			break;
		}
		// if($result==1)
			echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		// else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}
	public function uploadImage(){
		$result=upload("image");
		echo json_encode($result);
	}
	public function setLanguage(){
		$_SESSION['language']=$_POST['language'];
	}
	public function createVeriCode(){
		veri_code();
	}
	/*
	public function checkMobileCode(){
		if(isset($_POST['code']) && strcasecmp($_POST['code'],$_SESSION['mobilecode'])==0){
			echo json_encode(array("result"=>"success","message"=>"Right Security code!"));
		}else{
			echo json_encode(array("result"=>"failed","message"=>"Wrong Security code!"));
		}
	}
	public function checkEmail(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_email"=>$_POST['email']))){
			echo json_encode(array("result"=>"notunique","message"=>"The email already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"failed","message"=>"验证码输入错误！"));
		}
	}
	public function checkUsername(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_username"=>$_POST['username']))){
			echo json_encode(array("result"=>"notunique","message"=>"The username already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"success","message"=>"Success!"));
		}
	}
	public function checkEmailExist(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_email"=>$_POST['email']))){
			echo json_encode(array("result"=>"notunique","message"=>"The email already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"failed","message"=>"验证码输入错误！"));
		}
	}
	public function exportExcel($title,$subject,$description,$header,$data){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("AiiMai");
		$objPHPExcel->getProperties()->setLastModifiedBy("AiiMai");
		$objPHPExcel->getProperties()->setTitle($title);
		$objPHPExcel->getProperties()->setSubject($subject);
		$objPHPExcel->getProperties()->setDescription($description);
		$objPHPExcel->setActiveSheetIndex(0);
		//设值
		$letterArray=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		foreach($header as $index=>$field){
			$objPHPExcel->getActiveSheet()->setCellValue($letterArray[$index].'1',$field);
		}
		foreach($data as $key=>$value){
			foreach($value as $k=>$v){
				$objPHPExcel->getActiveSheet()->setCellValue($letterArray[$k].($key+2),$v);
			}
		}
		// Save Excel 2007 file
		//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		$fileName='uploads/'.$title.date("Ymd").'.xls';
		$objWriter->save($fileName);
//		$this->load->view('redirect',array("url"=>"/uploads/".$title.date("Ymd").".xls"));
		return '/'.$fileName;
	}*/
}