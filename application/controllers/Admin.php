<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->library('GetData');
		$this->load->model("Dbhandler");
	}
	public function checkAdminLogin(){
		if (!checkLogin() || strcmp($_SESSION["usertype"], "admin")) {
			$this->load->view('redirect',array("url"=>"/admin/login","info"=>"请先登录管理员账号"));
			return false;
		}else return true;
	}
	public function login(){
		$this->load->view('admin/login',array('title'=>"管理员登录"));
	}

	public function adminBaseHandler($title,$sider,$view,$data){
		if(!$this->checkAdminLogin()) return false;
//		$websiteConfig=$this->commongetdata->getWebsiteConfig("ALLINFO");
//		$websiteName=$websiteConfig['website_name_'.$_SESSION['language']];
		$this->load->view('admin/header',
			array(
				'title' => $title." - 山西教育在线",
				'showSider' => true,
				'sider' => $sider,
				'websiteName'=>"山西教育在线"
			)
		);
		$this->load->view('admin/'.$view,$data);
		$this->load->view('admin/footer');
	}
	public function index(){
		$parameters=array(
			'result'=>'count'
		);
		$amount=$this->getdata->getEssays($parameters);//总量
		$parameters['time']=array('begin'=>date("Y-m-d 00:00:00"),'end'=>date("Y-m-d H:i:s"));
		$todayAmount=$this->getdata->getEssays($parameters);//今天添加数量
		$parameters=array(
			'result'=>'data',
			'orderBy'=>array('time'=>'DESC'),
			'limit'=>array('limit'=>10,'offset'=>0)
		);
		$recentEssays=$this->getdata->getEssays($parameters);//获取近期添加
		$data=array(
			'amount'=>$amount,
			'todayAmount'=>$todayAmount,
			'recentEssays'=>$recentEssays
		);
		$this->adminBaseHandler('首页',array('index'=>true),'index',$data);
	}
	
	public function articlelist(){
		$this->load->view('admin/article-list');
	}
	public function articleadd(){
		$this->load->view('admin/article-add');
	}
	public function adminCommon($english,$chinese,$view='essaylist'){
		$baseUrl='/admin/'.$english.'?placeholder=true';
		$selectUrl='/admin/'.$english.'?placeholder=true';
		$currentPage=isset($_GET['page'])?$_GET['page']:1;
		$amountPerPage=20;
		$subColumns=$this->getdata->getColumns($english,true);
		$parameters=array();
		if(isset($_GET['column'])){
			$parameters['column']=$_GET['column'];
		}else{
			$parameters['columns']=$subColumns;
		}
		if(isset($_GET['keywords'])) $parameters['keywords']=$_GET['keywords'];

		$parameters['result']='count';
		$amount=$this->getdata->getEssays($parameters);
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);

		$parameters['result']='data';
		$parameters['limit']=$pageInfo['limit'];
		$parameters['orderBy']=array('time'=>'DESC');

		$essays=$this->getdata->getEssays($parameters);
		$data=array(
			'columnName'=>$chinese,
			'essays'=>$essays,
			'pageInfo'=>$pageInfo,
			'subColumns'=>$this->getdata->getColumns($english,false)
		);
		$this->adminBaseHandler($chinese.'管理',array('content'=>true,$english=>true),$view,$data);
	}
	public function home(){
		$this->adminCommon('home','首页内容');
	}
	public function activity(){
		$this->adminCommon('activity','品牌活动');
	}
	public function products(){
		$this->adminCommon('products','产品');
	}
	public function forum(){
		$this->adminCommon('forum','论坛','forumlist');
	}
}
