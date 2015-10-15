<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baidu extends CI_Controller {

	public function index()
	{
		// $this->load->view('welcome_message');
		$url="http://www.baidu.com/baidu?&ie=utf-8";
		if(isset($_GET['word'])){
			$url.="&word=".$_GET['word'];
		}
		if (isset($_GET['pn']) && is_numeric($_GET['pn'])) {
			$url.="&pn=".($_GET['pn']-1)."0";
		}
		$html=file_get_contents($url);
		//print_r($html);

		//preg_match('#<h3 class="(.*)">*<a.*?href *= *"(.*)".*>(.*)</a>#',$html,$result);
		preg_match_all('#<div.*?class="result.*?".*?>.*?<h3.*?class="t.*?".*?>.*?<a.*?href="(.*?)".*?>(.*?)</a>.*?</h3>(.*?)<div( class="f13"| class="c-gap-top-small"|).*?>.*?<span.*?class="(c-showurl|g).*?">(.*?)</span>.*?</div>.*?</div>#si',$html,$result);
		//class="(.*?)"    (.*?)<a(.*?)href="(.*?)"(.*?)>(.*?)</a>
		//echo sizeof($result);
		//print_r($result[2]);
		$data=array();
		for ($i=0; $i < sizeof($result[0]); $i++) { 
			$item=new stdClass();
			$item->title=$result[2][$i];
			$item->link=$result[1][$i];
			$item->description=$result[3][$i];
			$item->showlink=$result[4][$i];
			$data[]=$item;
		}
		echo json_encode($data);
	}
}
