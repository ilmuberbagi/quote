<?php

class Webmaster extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('quote_m');
		if($this->session->userdata('user_id') !== 'sabbana.returns@yahoo.com'){
			#alert('Upss, Anda tidak diijinken membuka halaman ini!');
			redirect(''); 
		}
	}
	
	public function index(){
		$this->load->view('webmaster/header');
		$this->load->view('webmaster/home');
		$this->load->view('webmaster/footer');
	}

	public function users(){
		$this->load->view('webmaster/header');
		$this->load->library('pagination');
		
		$totdata = $this->quote_m->countData('ilmuberb_quote.users');
		
		$config['base_url'] = base_url().'webmaster/users/';
		$config['total_rows'] = $totdata;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3; 
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#" style="font-weight:bold;background-color:#f5f5f5">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_links'] = 5;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = 'Firts';
		$config['last_link'] = 'Last';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['links'] = $this->pagination->create_links();

		if($page > 10){
			$limit = $page+10;
		}else{
			$limit = 10;
		}
		$data['users'] = $this->quote_m->getAllUsersLimit($limit, $this->uri->segment(3));
		$this->load->view('webmaster/users', $data);
		$this->load->view('webmaster/footer');
	}
	
	public function quotes(){
		$this->load->view('webmaster/header');
		$this->load->library('pagination');
		
		$totdata = $this->quote_m->countData('ilmuberb_quote.quote');
		
		$config['base_url'] = base_url().'webmaster/quotes/';
		$config['total_rows'] = $totdata;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3; 
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#" style="font-weight:bold;background-color:#f5f5f5">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_links'] = 5;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = 'Firts';
		$config['last_link'] = 'Last';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['links'] = $this->pagination->create_links();

		if($page > 10){
			$limit = $page+10;
		}else{
			$limit = 10;
		}
		$data['quotes'] = $this->quote_m->getAllQuotesLimit($limit, $this->uri->segment(3));
		$data['love'] = array();
		$data['thumb'] = array();
		if(!empty($data['quotes'])){
			foreach ($data['quotes'] as $a){
				$data['love']['_'.$a['qid']] = $this->quote_m->getLikeOfQuote($a['qid'], 0);
				$data['thumb']['_'.$a['qid']] = $this->quote_m->getLikeOfQuote($a['qid'], 1);
			}
		}
		$this->load->view('webmaster/quotes', $data);
		$this->load->view('webmaster/footer');
	}
	
	public function blockuser($id){
		$this->quote_m->blockuser($id);
		redirect('webmaster/users');
	}

	public function activateuser($id){
		$this->quote_m->activateuser($id);
		redirect('webmaster/users');	
	}
	
	public function deleteuser($id){
		$sql = "delete from ilmuberb_quote.users where md5(email) = '$id'";
		$this->db->query($sql);
		redirect('webmaster/users');
	}

}

