<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		$this->load->view('home/index');
	}
	public function product(){
		$this->load->view('home/product');
	}
	public function productlist(){
		$this->load->view('home/productlist');
	}
	public function comment(){
		$this->load->view('home/comment');
	}
	public function service(){
		$this->load->view('home/service');
	}
	public function productservice(){
		$this->load->view('home/productservice');
	}
	public function brand(){
		$this->load->view('home/brand');
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
