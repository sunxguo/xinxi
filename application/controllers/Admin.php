<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index(){
		$this->load->view('admin/index');
	}
	public function welcome(){
		$this->load->view('admin/welcome');
	}
	public function login(){
		$this->load->view('admin/login',array('title'=>"管理员登录"));
	}
	public function articlelist(){
		$this->load->view('admin/article-list');
	}
	public function articleadd(){
		$this->load->view('admin/article-add');
	}
}
