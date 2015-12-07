<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->library('GetData');
	}
	public function index(){
		$this->load->view('index',array(
			// 'about'=>$this->getdata->getAbout()
		));
	}
	public function index1(){
		$data=array();
		//滚动
		$parameters=array(
			'result'=>'data',
			'column'=>1,
			'orderBy'=>array('time'=>'DESC')
		);
		$data['sliders']=$this->getdata->getEssays($parameters);
		//轻断食果蔬汁
		$parameters=array(
			'result'=>'data',
			'column'=>2,
			'orderBy'=>array('time'=>'DESC')
		);
		$data['qingduanguoshus']=$this->getdata->getEssays($parameters);
		//沛时左侧滚动图
		$parameters=array(
			'result'=>'data',
			'column'=>3,
			'orderBy'=>array('time'=>'DESC')
		);
		$data['peishizuoce']=$this->getdata->getEssays($parameters);
		//沛时右侧'论坛'最新三条
		$parameters=array(
			'result'=>'data',
			'column'=>5,
			'limit'=>array('limit'=>3,'offset'=>0),
			'orderBy'=>array('time'=>'DESC')
		);
		$data['comment']=$this->getdata->getEssays($parameters);
		//'品牌活动'最新三条
		$parameters=array(
			'result'=>'data',
			'column'=>6,
			'limit'=>array('limit'=>3,'offset'=>0),
			'orderBy'=>array('time'=>'DESC')
		);
		$data['pinpaihuodong']=$this->getdata->getEssays($parameters);
		$this->load->view('home/index',$data);
	}
	public function product(){
		$this->load->view('home/product');
	}
	public function essay(){
		if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
			$this->load->view('redirect',array('info'=>'地址错误！'));
			return false;
		}
		$id=$_GET['id'];
		$data['essay']=$this->getdata->getContent('essay',$id);
		$this->load->view('home/essay',$data);
	}
	public function productlist(){
		$this->load->view('home/productlist');
	}
	public function comment(){
		//'论坛'
		$parameters=array(
			'result'=>'data',
			'column'=>5,
			'orderBy'=>array('time'=>'DESC')
		);
		$data['comments']=$this->getdata->getEssays($parameters);
		$this->load->view('home/comment',$data);
	}
	public function service(){
		$this->load->view('home/service');
	}
	public function productservice(){
		$this->load->view('home/productservice');
	}
	public function brand(){
		//'品牌活动'
		$parameters=array(
			'result'=>'data',
			'column'=>6,
			'orderBy'=>array('time'=>'DESC')
		);
		$data['pinpaihuodong']=$this->getdata->getEssays($parameters);
		$this->load->view('home/brand',$data);
	}
	public function hpp(){
		$this->load->view('home/hpp');
	}
	public function contactus(){
		$this->load->view('home/contactus');
	}
	public function aboutus(){
		$this->load->view('home/aboutus');
	}
	public function help(){
		$this->load->view('home/help');
	}
	public function inside(){
		$this->load->view('home/inside');
	}
}
