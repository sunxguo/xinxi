<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Common extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("upload");
		$this->load->library('GetData');
//		$this->load->library('PHPExcel');
		$this->load->model("dbHandler");
	}
	public function addInfo(){
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType){
			case "essay":
				$table="essay";
				$info=array(
					"column"=>$data->column,
					"title"=>$data->title,
					"islink"=>$data->islink,
					"link"=>$data->link,
					"summary"=>$data->summary,
					"content"=>$data->content,
					"thumbnail"=>$data->thumbnail,
					"author"=>1,
					"time"=>date("Y-m-d H:i:s")
				);
				if(isset($data->author)){
					$info['author']=$data->author;
				}
				if(isset($data->avatar)){
					$info['authorAvatar']=$data->avatar;
				}
			break;
			case "user":
				if($data->validcode!=$_SESSION['authcode']){
					echo json_encode(array("result"=>"failed","message"=>"验证码错误！"));
					return false;
				}
				$table='user';
				$info=array(
					"email"=>$data->email,
					"password"=>md5('SXJY'.($data->password)),
					"time"=>date("Y-m-d H:i:s")
				);
		}
		$result=$this->dbHandler->insertData($table,$info);
		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}
	public function modifyInfo(){
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		$where=array();
		switch($data->infoType){
			case "essay":
				$table="essay";
				$where=array('id'=>$data->id);
				$info=array(
					"column"=>$data->column,
					"title"=>$data->title,
					"summary"=>$data->summary,
					"islink"=>$data->islink,
					"link"=>$data->link,
					"content"=>$data->content,
					"thumbnail"=>$data->thumbnail,
					"time"=>date("Y-m-d H:i:s")
				);
				if(isset($data->author)){
					$info['author']=$data->author;
				}
				if(isset($data->avatar)){
					$info['authorAvatar']=$data->avatar;
				}
			break;
		}
		$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
	}
	public function deleteInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType){
			case 'essay':
				$condition['table']="essay";
				$condition['where']=array("id"=>$data->id);
			break;
		}
		$result=$this->dbHandler->deleteData($condition);
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息删除失败"));
	}
	public function getInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		$result=array();
		switch($data->infoType){
			case 'essay':
				$result=$this->getdata->getContent('essay',$data->id);
			break;
			case 'login':
				if(property_exists($data, "email") && property_exists($data, "password")){
					$email=$data->email;
					$password=$data->password;
					$info=$this->getdata->getContentAdvance('user',array('email'=>$email));
					if(property_exists($info,'email')){
						$post_pwd=MD5("SXJY".$password);
						$db_pwd=$info->password;
						if($post_pwd==$db_pwd){
							$_SESSION['useremail']=$info->email;
							$_SESSION['userid']=$info->id;
							$_SESSION['usertype']="user";
							echo json_encode(array("result"=>"success","message"=>"登录成功!"));
							return false;
						}
						else{
							echo json_encode(array("result"=>"failed","message"=>"密码错误!"));
							return false;
						}
					}
					else{
						echo json_encode(array("result"=>"failed","message"=>"用户名不存在!"));
						return false;
					}
				}else{
					echo json_encode(array("result"=>"failed","message"=>"请输入用户名和密码!"));
					return false;
				}
			break;
			case 'logout':
				unset($_SESSION["useremail"]);
				unset($_SESSION["userid"]);
				unset($_SESSION["usertype"]);
				$result='成功退出！';
			break;
		}
		echo json_encode(array("result"=>"success","message"=>$result));
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
	public function getWeather(){
		$url="http://www.weather.com.cn/adat/cityinfo/101100101.html";
		echo $result=httpGet($url);
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