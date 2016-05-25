<?php
class Test extends CI_Controller{

	function __construct(){
		parent::__construct();
		define ('URL_API', 'http://quote.ilmuberbagi.or.id/service/');
	}
	
	function index(){
		$postdata = http_build_query(array('api_kode'	=> 1000, 'api_datapost' => array(rand(1,3))));
		$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				));
		$context  = stream_context_create($opts);
		$result = json_decode(file_get_contents(URL_API.'getQuote', false, $context),true);		
		print_r($result);
		#$this->load->view('public/test', $data);	
	}
	
	function ajaxApi(){
		$this->load->view('public/test');	
	}

}