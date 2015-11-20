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
	public function adminCommonHandler($parameters){
		if(!$this->checkAdminLogin()) return false;
		$this->load->view('admin/_header');
		$this->load->view('admin/'.$parameters['view'],$parameters['data']);
		$this->load->view('admin/_footer');
	}
	public function index(){
		$parameters=array(
			'view'=>'index',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function welcome(){
		$parameters=array(
			'view'=>'welcome',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function articlelist(){
		$parameters=array(
			'view'=>'article-list',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function bannerlist(){
		$bannerParameters=array(
			'result'=>'count',
			'orderBy'=>array('edittime'=>'DESC')
		);
		if(isset($_GET['startTime'])){
			$bannerParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$bannerParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$bannerParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getBanners($bannerParameters);
		$baseUrl='/admin/bannerlist?placeholder=true';
		$selectUrl='/admin/bannerlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$bannerParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$banners=$this->getdata->getBanners($bannerParameters);

		$parameters=array(
			'view'=>'banner-list',
			'data'=>array('banners'=>$banners,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}
	public function banneradd(){
		$parameters=array(
			'view'=>'banner-add',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function banneredit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$banner=$this->getdata->getContent('banner',$_GET['id']);
		$parameters=array(
			'view'=>'banner-edit',
			'data'=>array('banner'=>$banner)
		);
		$this->adminCommonHandler($parameters);
	}
	public function buyerlist(){

		$bannerParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['gender'])){
			$bannerParameters['gender']=$_GET['gender'];//0-男；1-女
		}
		if(isset($_GET['startTime'])){
			$bannerParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$bannerParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$bannerParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getBuyers($bannerParameters);
		$baseUrl='/admin/buyerlist?placeholder=true';
		$selectUrl='/admin/buyerlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$bannerParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$buyers=$this->getdata->getBuyers($bannerParameters);

		$parameters=array(
			'view'=>'buyer-list',
			'data'=>array('buyers'=>$buyers,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}
	public function buyershow(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$buyer=$this->getdata->getContent('buyer',$_GET['id']);
		$defaultSuperMarket=$this->getdata->getContent('supermarket',$buyer->defaultsid);
		// $this->getdata->twoDimensionCode($text,$id);
		$parameters=array(
			'view'=>'buyer-show',
			'data'=>array('buyer'=>$buyer,'defaultSuperMarket'=>$defaultSuperMarket)
		);
		$this->adminCommonHandler($parameters);
	}
	public function sellershow(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$seller=$this->getdata->getContent('seller',$_GET['id']);
		$superMarket=$this->getdata->getContent('supermarket',$seller->sid);
		$parameters=array(
			'view'=>'seller-show',
			'data'=>array('seller'=>$seller,'superMarket'=>$superMarket)
		);
		$this->adminCommonHandler($parameters);
	}
	public function supermarketshow(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$supermarket=$this->getdata->getContent('supermarket',$_GET['id']);
		$parameters=array(
			'view'=>'supermarket-show',
			'data'=>array('supermarket'=>$supermarket)
		);
		$this->adminCommonHandler($parameters);
	}
	public function supermarketedit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$supermarket=$this->getdata->getContent('supermarket',$_GET['id']);
		$parameters=array(
			'view'=>'supermarket-edit',
			'data'=>array('supermarket'=>$supermarket)
		);
		$this->adminCommonHandler($parameters);
	}
	public function subsupermarketedit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$subsupermarket=$this->getdata->getContent('supermarket',$_GET['id']);
		$supermarkets=$this->getdata->getAllSupermarkets(false);
		$parameters=array(
			'view'=>'subsupermarket-edit',
			'data'=>array('subsupermarket'=>$subsupermarket,'supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function supermarketadd(){
		$parameters=array(
			'view'=>'supermarket-add',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function subsupermarketadd(){
		$supermarkets=$this->getdata->getAllSupermarkets(false);
		$parameters=array(
			'view'=>'subsupermarket-add',
			'data'=>array('supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	//超市管理
	public function supermarketlist(){

		$superMarketsParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['type'])){
			$superMarketsParameters['type']=$_GET['type'];//0-总；1-分
		}
		if(isset($_GET['startTime'])){
			$superMarketsParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$superMarketsParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$superMarketsParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getSupermarkets($superMarketsParameters);
		$baseUrl='/admin/supermarketlist?placeholder=true';
		$selectUrl='/admin/supermarketlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$superMarketsParameters['result']='data';
		// $superMarketsParameters['limit']=$pageInfo['limit'];
		$superMarkets=$this->getdata->getSupermarkets($superMarketsParameters);

		$parameters=array(
			'view'=>'supermarket-list',
			'data'=>array('superMarkets'=>$superMarkets,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}
	//超市账号管理
	public function sellermarketlist(){

		$bannerParameters=array(
			'result'=>'count',
			'role'=>1,
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['gender'])){
			$bannerParameters['gender']=$_GET['gender'];//0-男；1-女
		}
		if(isset($_GET['startTime'])){
			$bannerParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$bannerParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$bannerParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getSellers($bannerParameters);
		$baseUrl='/admin/sellermarketlist?placeholder=true';
		$selectUrl='/admin/sellermarketlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$bannerParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$sellers=$this->getdata->getSellers($bannerParameters);

		$parameters=array(
			'view'=>'sellermarket-list',
			'data'=>array('sellers'=>$sellers,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}

	public function sellermarketadd(){
		$supermarkets=$this->getdata->getAllSupermarkets(false);
		$parameters=array(
			'view'=>'sellermarket-add',
			'data'=>array('supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function sellermarketedit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$seller=$this->getdata->getContent('seller',$_GET['id']);
		$seller->subSupermarket=$this->getdata->getContent('supermarket',$seller->sid);
		$supermarkets=$this->getdata->getAllSupermarkets(false);
		$subParameters=array(
			'result'=>'data',
			'no'=>$seller->subSupermarket->no,
			'type'=>1,
		);
		$subSupermarkets=$this->getdata->getSupermarkets($subParameters);//获取对应所有分店
		$parameters=array(
			'view'=>'sellermarket-edit',
			'data'=>array('seller'=>$seller,'supermarkets'=>$supermarkets,'subSupermarkets'=>$subSupermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	//物流账号管理
	public function sellerdeliverylist(){

		$bannerParameters=array(
			'result'=>'count',
			'role'=>0,
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['gender'])){
			$bannerParameters['gender']=$_GET['gender'];//0-男；1-女
		}
		if(isset($_GET['startTime'])){
			$bannerParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$bannerParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$bannerParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getSellers($bannerParameters);
		$baseUrl='/admin/sellerdeliverylist?placeholder=true';
		$selectUrl='/admin/sellerdeliverylist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$bannerParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$sellers=$this->getdata->getSellers($bannerParameters);

		$parameters=array(
			'view'=>'sellerdelivery-list',
			'data'=>array('sellers'=>$sellers,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}

	public function sellerdeliveryadd(){
		$supermarkets=$this->getdata->getAllSupermarkets(false);
		$parameters=array(
			'view'=>'sellerdelivery-add',
			'data'=>array('supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function sellerdeliveryedit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$seller=$this->getdata->getContent('seller',$_GET['id']);
		$seller->subSupermarket=$this->getdata->getContent('supermarket',$seller->sid);
		$supermarkets=$this->getdata->getAllSupermarkets(false);
		$subParameters=array(
			'result'=>'data',
			'no'=>$seller->subSupermarket->no,
			'type'=>1,
		);
		$subSupermarkets=$this->getdata->getSupermarkets($subParameters);//获取对应所有分店
		$parameters=array(
			'view'=>'sellerdelivery-edit',
			'data'=>array('seller'=>$seller,'supermarkets'=>$supermarkets,'subSupermarkets'=>$subSupermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function sellerchangepassword(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$seller=$this->getdata->getContent('seller',$_GET['id']);
		$parameters=array(
			'view'=>'sellerchange-password',
			'data'=>array('seller'=>$seller)
		);
		$this->adminCommonHandler($parameters);
	}
	public function articleadd(){
		$parameters=array(
			'view'=>'article-add',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function productbrand(){
		$parameters=array(
			'view'=>'product-brand',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function productlist(){
		$productParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['sid'])){
			$productParameters['sid']=$_GET['sid'];
		}
		if(isset($_GET['categoryid'])){
			$productParameters['categoryid']=$_GET['categoryid'];
		}
		if(isset($_GET['startTime'])){
			$productParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$productParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$productParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getProducts($productParameters);
		$baseUrl='/admin/productlist?placeholder=true';
		$selectUrl='/admin/productlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$productParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$products=$this->getdata->getProducts($productParameters);
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		if(isset($_GET['sid'])){
			$categories=$this->getdata->getCategories(array(
				'result'=>'data',
				'sid'=>$_GET['sid']
			));
		}else{
			$categories=array();
		}
		$parameters=array(
			'view'=>'product-list',
			'data'=>array('products'=>$products,'pageInfo'=>$pageInfo,'supermarkets'=>$supermarkets,'categories'=>$categories)
		);

		$this->adminCommonHandler($parameters);
	}
	public function orderlist(){
		$orderParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['sid'])){
			$orderParameters['sid']=$_GET['sid'];
		}
		if(isset($_GET['categoryid'])){
			$orderParameters['categoryid']=$_GET['categoryid'];
		}
		if(isset($_GET['startTime'])){
			$orderParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$orderParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$orderParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getOrders($orderParameters);
		$baseUrl='/admin/orderlist?placeholder=true';
		$selectUrl='/admin/orderlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$orderParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$orders=$this->getdata->getOrders($orderParameters);
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		$parameters=array(
			'view'=>'order-list',
			'data'=>array('orders'=>$orders,'pageInfo'=>$pageInfo,'supermarkets'=>$supermarkets)
		);

		$this->adminCommonHandler($parameters);
	}
	public function addresslist(){
		$addressorderParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['startTime'])){
			$addressorderParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$addressorderParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$addressorderParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getAddresses($addressorderParameters);
		$baseUrl='/admin/addresslist?placeholder=true';
		$selectUrl='/admin/addresslist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$addressorderParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$addresses=$this->getdata->getAddresses($addressorderParameters);
		$parameters=array(
			'view'=>'address-list',
			'data'=>array('addresses'=>$addresses,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}
	public function commentlist(){
		$commentParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['startTime'])){
			$commentParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$commentParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$commentParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getComments($commentParameters);
		$baseUrl='/admin/commentlist?placeholder=true';
		$selectUrl='/admin/commentlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$commentParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$comments=$this->getdata->getComments($commentParameters);
		$parameters=array(
			'view'=>'comment-list',
			'data'=>array('comments'=>$comments,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}
	public function advicelist(){
		$adviceParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['startTime'])){
			$adviceParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$adviceParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$adviceParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getAdvices($adviceParameters);
		$baseUrl='/admin/commentlist?placeholder=true';
		$selectUrl='/admin/commentlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$adviceParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$advices=$this->getdata->getAdvices($adviceParameters);
		$parameters=array(
			'view'=>'advice-list',
			'data'=>array('advices'=>$advices,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}
	public function aboutuslist(){
		$aboutusParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		// if(isset($_GET['startTime'])){
		// 	$adviceParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		// }
		// if(isset($_GET['endTime'])){
		// 	$adviceParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		// }
		// if(isset($_GET['keywords'])){
		// 	$adviceParameters['keywords']=$_GET['keywords'];
		// }
		$amount=$this->getdata->getAboutus($aboutusParameters);
		$baseUrl='/admin/aboutuslist?placeholder=true';
		$selectUrl='/admin/aboutuslist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$aboutusParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$aboutus=$this->getdata->getAboutus($aboutusParameters);
		$parameters=array(
			'view'=>'aboutus-list',
			'data'=>array('aboutus'=>$aboutus,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}
	public function aboutusadd(){
		$parameters=array(
			'view'=>'aboutus-add',
			'data'=>array()
		);
		$this->adminCommonHandler($parameters);
	}
	public function aboutusedit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$aboutus=$this->getdata->getContent('aboutus',$_GET['id']);
		$parameters=array(
			'view'=>'aboutus-edit',
			'data'=>array('aboutus'=>$aboutus)
		);
		$this->adminCommonHandler($parameters);
	}
	public function couponlist(){
		$couponParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['startTime'])){
			$couponParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$couponParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['sid'])){
			$couponParameters['sid']=$_GET['sid'];
		}
		$amount=$this->getdata->getCoupons($couponParameters);
		$baseUrl='/admin/couponlist?placeholder=true';
		$selectUrl='/admin/couponlist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$couponParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$coupons=$this->getdata->getCoupons($couponParameters);
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		$parameters=array(
			'view'=>'coupon-list',
			'data'=>array('coupons'=>$coupons,'pageInfo'=>$pageInfo,'supermarkets'=>$supermarkets)
		);

		$this->adminCommonHandler($parameters);
	}
	public function categorylist(){
		$categoryParameters=array(
			'result'=>'count',
			'limit'=>array('limit'=>10,'offset'=>0),
			'orderBy'=>array('addtime'=>'DESC')
		);
		if(isset($_GET['sid'])){
			$categoryParameters['sid']=$_GET['sid'];
		}
		if(isset($_GET['startTime'])){
			$categoryParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$categoryParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$categoryParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getCategories($categoryParameters);
		$baseUrl='/admin/categorylist?placeholder=true';
		$selectUrl='/admin/categorylist?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$categoryParameters['result']='data';
		// $bannerParameters['limit']=$pageInfo['limit'];
		$categories=$this->getdata->getCategories($categoryParameters);
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		$parameters=array(
			'view'=>'category-list',
			'data'=>array('categories'=>$categories,'pageInfo'=>$pageInfo,'supermarkets'=>$supermarkets)
		);

		$this->adminCommonHandler($parameters);
	}
	public function productadd(){
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		$parameters=array(
			'view'=>'product-add',
			'data'=>array('supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function categoryedit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$category=$this->getdata->getContent('category',$_GET['id']);
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		$parameters=array(
			'view'=>'category-edit',
			'data'=>array('category'=>$category,'supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function categoryadd(){
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		$parameters=array(
			'view'=>'category-add',
			'data'=>array('supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function productedit(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$product=$this->getdata->getContent('goods',$_GET['id']);
		$categories=$this->getdata->getCategories(
					array(
						'result'=>'data',
						'sid'=>$product->sid,
						'orderBy'=>array('order'=>'ASC')
					)
				);
		$supermarkets=$this->getdata->getAllSupermarkets(true,false);
		$parameters=array(
			'view'=>'product-edit',
			'data'=>array('product'=>$product,'categories'=>$categories,'supermarkets'=>$supermarkets)
		);
		$this->adminCommonHandler($parameters);
	}
	public function productshow(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$product=$this->getdata->getContent('goods',$_GET['id']);
		$supermarket=$this->getdata->getContent('supermarket',$product->sid);
		$category=$this->getdata->getContent('category',$product->categoryid);
		$parameters=array(
			'view'=>'product-show',
			'data'=>array('product'=>$product,'category'=>$category,'supermarket'=>$supermarket)
		);
		$this->adminCommonHandler($parameters);
	}
	public function ordershow(){
		if(!isset($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$status=$this->getdata->getOrderStatus();
		$order=$this->getdata->getContentAdvance('order',array('orderno'=>$_GET['id']));
		$order->supermarket=$this->getdata->getContent('supermarket',$order->sid);
		$order->buyer=$this->getdata->getContent('buyer',$order->buyerid);
		$order->seller=$this->getdata->getContent('seller',$order->sellerid);
		$order->address=$this->getdata->getContent('address',$order->addressid);
		$order->coupon=$this->getdata->getContent('coupon',$order->couponid);
		$order->details=$this->getdata->getOrderDetail($order->orderno);
		$order->status_zn=$status[$order->status];
		$parameters=array(
			'view'=>'order-show',
			'data'=>array('order'=>$order)
		);
		$this->adminCommonHandler($parameters);
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
