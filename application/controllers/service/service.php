<?php

class Service extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('api_model');
	}

	function index(){
		echo 'SERVICE-K'.rand(100,900);
	}
		
	public function getQuote($format = 'json'){
		$query = null;
		if(isset($_POST['api_kode']) && isset($_POST['api_datapost'])){
			$kode 		= (int)preg_replace("/[^0-9]/", "", $_POST['api_kode']);
			$datapost	= $_POST['api_datapost'];
			$err_number = 404;
			
			switch($kode){
				case 1000: 
					$query = $this->api_model->getQuote($datapost[0]);
				break;
				case 1001: 
					$query = $this->api_model->getQuoteLimit($datapost[0], $datapost[1]);
				break;
				case 1002: 
					$query = $this->api_model->getQuoteUser($datapost[0], $datapost[1], $datapost[2]);
				break;
			}
		}
		$this->_formatjson($query);
	}

	private function _formatjson($data = array()){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		echo json_encode($data);
	}
}