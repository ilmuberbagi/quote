<?php

class Quote extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('quote_m');
	}
	
	function index(){
		$this->load->view('public/header');
		$this->load->view('public/home');
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}

	function cs(){
		print_r($this->session->all_userdata());
	}

	function quotes($kat = null, $qid = null){
		if($qid == null){
			if($kat == 'wisdom'){
				$data['quote'] = $this->quote_m->getQuote(1);
			}else if($kat == 'spirit'){
				$data['quote'] = $this->quote_m->getQuote(2);
			}else{
				$data['quote'] = $this->quote_m->getQuote(3);
			}
		}else{
			$data['quote'] = $this->quote_m->getSingleData('quote','qid', $qid);
		}
		# ATRIBUT
		$user = $this->session->userdata('user_id');
		
		if(!empty($data['quote'])){
			$data['isLove'] = $this->quote_m->islike($user, $data['quote'][0]['qid'], 0);
			$data['isThumb'] = $this->quote_m->islike($user, $data['quote'][0]['qid'], 1);
			$data['love'] = $this->quote_m->getLikeOfQuote($data['quote'][0]['qid'], 0);
			$data['thumb'] = $this->quote_m->getLikeOfQuote($data['quote'][0]['qid'], 1);
			
			# api detail user get data and avatar
			define('AUTH_API_URL','http://services.ilmuberbagi.id/member');
			$params = array('api_kode' => 1002, 'api_datapost' => array('member_email'=> $data['quote'][0]['email']));
			$postdata = http_build_query($params);
			$param = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				));
			$context  = stream_context_create($param);
			$user_api = json_decode(file_get_contents(AUTH_API_URL, false, $context), TRUE);
		}
		
		$data['avatar'] = 'http://portal.ilmuberbagi.id/assets/img/foto/default.png';
		if(!empty($user_api)){
			$data['quoter'] = $user_api[0]['member_name'];
			$avatar = $user_api[0]['member_image_profile'] ? $user_api[0]['member_image_profile'] : $data['quote'][0]['pic'];
			$data['avatar'] = $avatar ? $avatar : 'http://portal.ilmuberbagi.id/assets/img/foto/default.png';			
		}else{
			$data['quoter'] = $data['quote'][0]['first_name'];
			$data['avatar'] = $data['quote'][0]['pic'];
		}
		
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		
		$this->load->view('public/header', $data);
		$this->load->view('public/quotes', $data);		
		$this->load->view('public/footer', $data);
	}

	function about(){
		$this->load->view('public/header');
		$this->load->view('public/about');

		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}


	function post(){
		$this->load->view('public/header');
		$this->load->view('public/post');
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}

	function simpanPost(){
		$g = array(1=>'wisdom','spirit','joke');
		if($this->session->userdata('user_id') == ''){
			$sts = 0;
		}else{
			$sts = 1;
		}
		$data = array(
			'qig'	=> $this->input->post('group'),
			'email'	=> $this->input->post('id'),
			'isi'	=> strip_tags($this->input->post('quote')),
			'status'=> $sts,
		);
		$simpan = $this->quote_m->saveData('quote', $data);
		redirect('quotes/'.$g[$data['qig']]);
	}

	function signup(){
		$this->load->view('public/header');
		$this->load->view('public/signup');
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}
	
	
	function bodyMail($email){
		$key = md5($email);
		$html = "
			<html><body>
			<table border='0'>
			<tr><td><img src='".base_url('asset/img/logoQB.png')."' width='40'> <b>Quote Berbagi</b></td></tr>
			<tr><td>Selamat Anda telah terdaftar sebagai member QUOTE BERBAGI, Untuk verifikasi akun Anda, silahkan klik <a href='".base_url('aktivasiAkun/'.$key)."'> Link Aktivasi Akun ini!</a></td></tr>
			<tr><td><h2>Selamat Mengudara dan Salam Berbagi!</h2></td></tr>
			</table></body></html>
		";
		return $html;
	}
	
	function simpanAkun(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password','Password','required|alpha_dash');
		if($this->form_validation->run() == false){
			$this->signup();
		}else{
	
			if($this->input->post('gender') == 1){
				$pic = 'male.png';
			}else { $pic = 'female.png'; }
			$email = $this->input->post('email');
			$dataAkun = array(
				'email'			=> $email,
				'password'		=> md5($this->input->post('password')),
				'first_name'	=> $this->input->post('fname'),
				'last_name'		=> $this->input->post('lname'),
				'gender'		=> $this->input->post('gender'),
				'pic'			=> $pic,
				'twitter'		=> $this->input->post('website'),
				'first_quote'	=> $this->input->post('quote'),
			);
			$signup = $this->quote_m->saveData('users', $dataAkun);
			if($signup){
				# LOAD HELPER & LIBRARY EMAIL
				$this->load->helper('email');
				$config = array(
					'mailtype'  => 'html', 
					'charset' => 'utf-8',
					'wordwrap' => TRUE
				);
				$this->load->library('email', $config);
				$msg = $this->bodyMail($email);
				if(valid_email($email)){
					
					$this->email->from('quote@ilmuberbagi.or.id','Quote Berbagi');
					$this->email->to($email);
					$this->email->subject('Verifikasi Akun Quote Berbagi');
					$this->email->message($msg);
					
					# EXECUTE
					if (!$this->email->send()){
						$data['message'] = '<b>Proses pengiriman email Anda gagal!</b><p>Mohon maaf atas kesalahan teknis yang sedang terjadi. Silakan coba beberapa saat lagi.</p>';
						$data['status'] = 'error';
						$this->load->view('public/header');
						$this->load->view('public/konfirmasi_msg', $data);
						$this->load->view('public/footer');
					}else{
						# SUCCESS SEND MESSAGE
						$data['message'] ="<b>Selamat Anda telah terdaftar sebagai member Quote Berbagi!</b><br/>Silakan lakukan aktivasi akun anda dengan membuka email Anda $email";
						$data['status'] ="info";
						$this->load->view('public/header');
						$this->load->view('public/konfirmasi_msg',$data);
						$this->load->view('public/footer');
					}
				}else{
					$data['message'] ="<b>Alamat email yang Anda masukkan tidak valid.</b>";
					$data['status'] ="error";
					$this->load->view('public/header');
					$this->load->view('public/konfirmasi_msg',$data);
					$this->load->view('public/footer');
				}
			}
		}
	}
	
	function removequote($qid){
		$url = md5($this->session->userdata('user_id'));
		$act = $this->quote_m->deleteQuote($qid);
		redirect('userQuote/'.$url);
	}
	
	function removequotewm($qid){
		$act = $this->quote_m->deleteQuote($qid);
		redirect('webmaster/quotes');
	}
	
	function blockquote($qid){
		$act = $this->quote_m->blockQuote($qid);
		redirect('webmaster/quotes');
	}
	
	function activequotewm($qid){
		$act = $this->quote_m->activeQuote($qid);
		redirect('webmaster/quotes');
	}
	
	function userQuote($id, $type = null){
		$data['title'] = 'Kumpulan Quote '.$this->session->userdata('name');
		$this->load->view('public/header', $data);
		$g = array(1=>'Wisdom', 'Spirit', 'Joke', 'Semua');
		$data['qlist'] = $this->quote_m->getUserQuote($id, $type);
		if(!empty($data['qlist'])){
			$data['qlist'] = $this->quote_m->getUserQuote($id, $type);			
		}else{
			if($type == ''){ $type = 4; }
			$data['qlist'] = $this->quote_m->getUserQuote($id,'');
			$data['message'] = 'Quote '.$g[$type].' masih kosong!';
		}
		$data['love'] = array();
		$data['thumb'] = array();
		if(!empty($data['qlist'])){
			foreach ($data['qlist'] as $q){
				$data['love']['_'.$q['qid']] = $this->quote_m->getLikeOfQuote($q['qid'], 0);
				$data['thumb']['_'.$q['qid']] = $this->quote_m->getLikeOfQuote($q['qid'], 1);
			}
		
			$email = $data['qlist'][0]['email'];
			// echo $email; die();
			# ====================
			# api detail user get data and avatar
			define('AUTH_API_URL','http://services.ilmuberbagi.id/member');
			$params = array('api_kode' => 1002, 'api_datapost' => array('member_email'=> $email));
			$postdata = http_build_query($params);
			$param = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				));
			$context  = stream_context_create($param);
			$user_api = json_decode(file_get_contents(AUTH_API_URL, false, $context), TRUE);
			if(!empty($user_api)){
				$data['website'] = $user_api[0]['member_blog'];
				$data['motivation'] = $user_api[0]['member_motivation'];
				$data['quoter'] = $user_api[0]['member_name'];
				$data['avatar'] = $user_api[0]['member_image_profile'] ?  $user_api[0]['member_image_profile']:'';
			}else{
				$data['website'] = $data['qlist'][0]['twitter'];
				$data['motivation'] = $data['qlist'][0]['first_quote'];
				$data['quoter'] = $data['qlist'][0]['first_name'];
				$data['avatar'] = 'http://portal.ilmuberbagi.id/assets/img/foto/default.png';
			}
		}
		$this->load->view('public/quoteList', $data);
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}
	
	function action($type = '', $qid = ''){
		$group = $this->uri->segment(2);
		$user = $this->session->userdata('user_id');
		$kode = array('love'=>0, 'thumb' =>1);
		$dataLike = array(
			'qid'	=> $qid,
			'email'	=> $user,
			'ltype'	=> $kode[$type],
		);
		$isLike = $this->quote_m->isLike($user, $qid, $kode[$type]);
		if($isLike == 0){
			$action = $this->quote_m->saveData('likes', $dataLike);
		}else{
			$action  = $this->quote_m->batalLike($user, $qid, $kode[$type]);
		}
		if($action){
			$this->quotes($group, $qid);
		}
	}
	
	function aktivasiAkun($email){
		$act = $this->quote_m->aktivationAccount($email);
		if($act){
			$data['title'] ="Selamat Datang di Quote Berbagi";
			$this->load->view('public/header');
			$data['message'] = '<b>Selamat Akun Anda telah aktif!</b><br/>Anda sudah bisa <b>Login</b> dengan menggunakan akun Anda<br/>Selamat Bergabung dengan orang-orang yang Inspiratif :)';
			$data['status'] = 'success';
			$this->load->view('public/konfirmasi_msg',$data);
			$this->load->view('public/footer');
		}else{
			$data['title'] ="Informasi Aktivasi Akun";
			$this->load->view('public/header');
			$data['message'] = '<b>Terjadi masalah pada saat proses aktivasi Akun Anda!</b><br/>Mohon Maaf atas kesalahan teknis yang sedang terjadi, tunggulah beberapa saat untuk proses aktivasi akun Anda :(';
			$data['status'] = 'error';
			$this->load->view('public/konfirmasi_msg',$data);
			$this->load->view('public/footer');		
		}
	}
	
	function resetpassword(){
		$data['title'] = 'Reset Password';
		$this->load->view('public/header', $data);
		$this->load->view('public/resetpassword');

		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}
	
	
	function setting($id){
		if(md5($this->session->userdata('user_id')) == $id){
			$data['title'] = 'Setting Akun';
			$this->load->view('public/header', $data);
			$data['user'] = $this->quote_m->getCurrentUser($id);
			# api detail user get data and avatar
			# =================================
			define('AUTH_API_URL','http://services.ilmuberbagi.id/member');
			$params = array('api_kode' => 1002, 'api_datapost' => array('member_email'=> $data['user'][0]['email']));
			$postdata = http_build_query($params);
			$param = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				));
			$context  = stream_context_create($param);
			$user_api = json_decode(file_get_contents(AUTH_API_URL, false, $context), TRUE);
			if(!empty($user_api))
				$data['avatar'] = $user_api[0]['member_image_profile'] ?  $user_api[0]['member_image_profile']: $this->session->userdata('avatar');
			
			$this->load->view('public/setting_akun', $data);

			$data['q1'] = $this->quote_m->getQuote(1);
			$data['q2'] = $this->quote_m->getQuote(2);
			$data['q3'] = $this->quote_m->getQuote(3);
			$this->load->view('public/footer', $data);
		}else{ redirect(''); }
	}
		
	function search(){		
		$q = $_GET['q'];
		$data['title'] = 'Quote Berbagi : Search = '.$q;
		$data['keyword'] = 'Pencarian Quote dengan keyword <span class="label">'.$q.'</span>';
		$this->load->view('public/header', $data);
		
		$data['quotes'] = $this->quote_m->searchQuote($q);
		if(!empty($data['quotes'])){
			$a = 0;
			define('AUTH_API_URL','http://services.ilmuberbagi.id/member');
			foreach ($data['quotes'] as $q){
				# api detail user get data and avatar
				$params = array('api_kode' => 1002, 'api_datapost' => array('member_email'=> $q['email']));
				$postdata = http_build_query($params);
				$param = array('http' =>
					array(
						'method'  => 'POST',
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						'content' => $postdata
					));
				$context  = stream_context_create($param);
				$user_api = json_decode(file_get_contents(AUTH_API_URL, false, $context), TRUE);
				if(!empty($user_api))
					$data['quoter'][$a] = $user_api[0]['member_name'] ?  $user_api[0]['member_name']: 'anonymous';
				else
					$data['quoter'][$a] = $q['first_name'];
				$a++;
			}
		}
		$this->load->view('public/quoteListSearch', $data);
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}	
	
}

