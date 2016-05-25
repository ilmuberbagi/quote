<?php

class Developer extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('quote_m');
	}
	
	function index(){
		$data['title'] = 'Developer Quote Berbagi';
		$this->load->view('public/header', $data);
		$this->load->view('public/developer');
		$this->load->view('public/footer', $data);
	}
	
	function ketentuan(){
		redirect('pengembang');
	}
	
	function bantuan(){
		redirect('pengembang');	
	}
	
	function framequote(){
		$id = rand(1,3);
		$data['quote'] = $this->quote_m->getQuote($id);
		$this->load->view('public/simpleView', $data);
	}


}