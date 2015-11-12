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

// 	public function adminBaseHandler($title,$sider,$view,$data){
// 		if(!$this->checkAdminLogin()) return false;
// //		$websiteConfig=$this->commongetdata->getWebsiteConfig("ALLINFO");
// //		$websiteName=$websiteConfig['website_name_'.$_SESSION['language']];
// 		$this->load->view('admin/header',
// 			array(
// 				'title' => $title." - 沛时Perse",
// 				'showSider' => true,
// 				'sider' => $sider,
// 				'websiteName'=>"沛时Perse"
// 			)
// 		);
// 		$this->load->view('admin/'.$view,$data);
// 		$this->load->view('admin/footer');
// 	}
	public function index(){
		$data=array();
		$this->load->view('admin/index',$data);
	}
	public function welcome(){
		$data=array();
		$this->load->view('admin/welcome',$data);
	}
	
	public function articlelist(){
		$this->load->view('admin/article-list');
	}
	public function articleadd(){
		$this->load->view('admin/article-add');
	}
	public function productbrand(){
		$this->load->view('admin/product-brand');
	}
	public function productlist(){
		$this->load->view('admin/_header');
		$this->load->view('admin/product-list');
		$this->load->view('admin/_footer');
	}
	public function productcategory(){
		$this->load->view('admin/product-category');
	}
	// public function adminCommon($english,$chinese,$view='essaylist'){
	// 	$baseUrl='/admin/'.$english.'?placeholder=true';
	// 	$selectUrl='/admin/'.$english.'?placeholder=true';
	// 	$currentPage=isset($_GET['page'])?$_GET['page']:1;
	// 	$amountPerPage=20;
	// 	$subColumns=$this->getdata->getColumns($english,true);
	// 	$parameters=array();
	// 	if(isset($_GET['column'])){
	// 		$parameters['column']=$_GET['column'];
	// 	}else{
	// 		$parameters['columns']=$subColumns;
	// 	}
	// 	if(isset($_GET['keywords'])) $parameters['keywords']=$_GET['keywords'];

	// 	$parameters['result']='count';
	// 	$amount=$this->getdata->getEssays($parameters);
	// 	$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);

	// 	$parameters['result']='data';
	// 	$parameters['limit']=$pageInfo['limit'];
	// 	$parameters['orderBy']=array('time'=>'DESC');

	// 	$essays=$this->getdata->getEssays($parameters);
	// 	$data=array(
	// 		'columnName'=>$chinese,
	// 		'essays'=>$essays,
	// 		'pageInfo'=>$pageInfo,
	// 		'subColumns'=>$this->getdata->getColumns($english,false)
	// 	);
	// 	$this->adminBaseHandler($chinese.'管理',array('content'=>true,$english=>true),$view,$data);
	// }
	// public function home(){
	// 	$this->adminCommon('home','首页内容');
	// }
	// public function activity(){
	// 	$this->adminCommon('activity','品牌活动');
	// }
	// public function products(){
	// 	$this->adminCommon('products','产品');
	// }
	// public function forum(){
	// 	$this->adminCommon('forum','论坛','forumlist');
	// }
}
