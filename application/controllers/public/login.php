<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('quote_m');
	}
	
	function index(){
		$this->form_validation->set_rules('user','<b>Email</b>','trim|required|xss_clean');
		$this->form_validation->set_rules('password','<b>Password</b>','trim|required|xss_clean|callback_cek_login');
		
		if ($this->form_validation->run() == false){
			$this->session->set_flashdata('msg',1);
			$this->load->view('public/header');
			$this->load->view('public/signin');
			$data['q1'] = $this->quote_m->getQuote(1);
			$data['q2'] = $this->quote_m->getQuote(2);
			$data['q3'] = $this->quote_m->getQuote(3);
			$this->load->view('public/footer', $data);
		}
		else{
			if ($this->session->userdata('logStatus') == 1){
				redirect('');
			}else{
				$this->load->view('public/header');
				$data['message'] = '<b>Akun Anda belum diverifikasi!</b><p>Silakan lakukan verifikasi akun untuk aktivasi akun anda di '.$this->session->userdata('user_id').'</p>';
				$data['status'] = 'alert';
				$this->session->sess_destroy();
				$this->load->view('public/konfirmasi_msg',$data);
				$data['q1'] = $this->quote_m->getQuote(1);
				$data['q2'] = $this->quote_m->getQuote(2);
				$data['q3'] = $this->quote_m->getQuote(3);
				$this->load->view('public/footer', $data);
			}
		}
		
	}
	private function clean($str){
		$str = str_replace(array('"','"'),'', $str);
		return $this->security->xss_clean($str);
	}

	function cek_login(){
		define('AUTH_API_URL','http://services.ilmuberbagi.id/auth/user');
		$datapost = array(
			'username'	=> $this->clean($this->input->post('user')),
			'password'	=> $this->clean($this->input->post('password'))
		);
		$postdata = http_build_query(array('api_kode' => 1000, 'api_datapost' => $datapost));
		$param = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			));
		$context  = stream_context_create($param);
		$user = json_decode(file_get_contents(AUTH_API_URL, false, $context), TRUE);
		# get user privilage
		if(!empty($user)){
			$postdata = http_build_query(array('api_kode' => 2000, 'api_datapost' => array('member_id'=>$user[0]['member_id'])));
			$param = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				));
			$context  = stream_context_create($param);
			$priv = json_decode(file_get_contents(AUTH_API_URL, false, $context), TRUE);
			$create_session = array(
				'user_id'			=> $user[0]['member_email'],
				'ibf_token_string'	=> 'IBF'.md5($user[0]['member_id']),
				'email'			=> $user[0]['member_email'],
				'username'		=> $datapost['username'],
				'name'			=> $user[0]['member_name'],
				'avatar'		=> $user[0]['member_image_profile'],
				'logStatus'		=> $user[0]['member_status'],
				'type'			=> $user[0]['member_type'],
				'ibf_code'		=> $user[0]['member_ibf_code'],
				'privilage'		=> $priv[0],
			);
			$this->session->set_userdata($create_session);
			redirect();
		}else{
			$this->form_validation->set_message('cek_login','Kombinasi Username dan password tidak valid!');
			return false;
		}
	}
	
	
	function cek_login_old($password){
		$username = $this->input->post('user');
		$login = $this->quote_m->auth($username, $password);
		if ($login){
			foreach($login as $data){
				$create_session = array(
					'user_id'		=> $username,
					'logStatus' 	=> $data['status'],
					'name'			=> $data['first_name'],
					'lname'			=> $data['last_name'],
					'date_reg'		=> $data['date_reg'],
					'sistem'		=> $data['sistem'],
					'lahir'			=> $data['birth_date'],
					'fquote'		=> $data['first_quote'],
				);
				if($data['sistem'] == 'ib'){
					$create_session['avatar'] = 'http://portal.ilmuberbagi.id/assets/img/foto/default.png';
				}else{
					$create_session['avatar'] = $data['pic'];
				}
				$this->session->set_userdata($create_session);
			}
			return true;
		}
		else{			
			$this->form_validation->set_message('cek_login','Kombinasi Username dan password tidak valid!');
			return false;
		}
	}	
	
	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

}