<?php

class Profile extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('quote_m');
		if($this->session->userdata('logStatus') != 1) redirect('');
	}
	
	function index(){
		$data['userQuote'] = '1000';
		$this->load->view('public/header');
		$user = $this->session->userdata('user_id');
		$data['jmlQuote'] = $this->quote_m->countQouteGroupUser($user, null);
		$data['jmlLove'] = $this->quote_m->countLikeUser($user, 0);
		$data['jmlThumb'] = $this->quote_m->countLikeUser($user, 1);
		
		# ====================
		# api detail user get data and avatar
		define('AUTH_API_URL','http://services.ilmuberbagi.id/member');
		$params = array('api_kode' => 1002, 'api_datapost' => array('member_email'=> $user));
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

		
		$this->load->view('public/profile', $data);
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		$this->load->view('public/footer', $data);
	}

	function quotes($kat = null, $qid = null){
		if($kat == 'wisdom'){
			$data['quote'] = $this->quote_m->getQuote(1);
		}else if($kat == 'spirit'){
			$data['quote'] = $this->quote_m->getQuote(2);
		}else{
			$data['quote'] = $this->quote_m->getQuote(3);
		}
		$data['q1'] = $this->quote_m->getQuote(1);
		$data['q2'] = $this->quote_m->getQuote(2);
		$data['q3'] = $this->quote_m->getQuote(3);
		
		$this->load->view('public/header', $data);
		$this->load->view('public/quotes', $data);		
		$this->load->view('public/footer', $data);
	}


	/**
	 * change picture profile features was diabled since we integrated with member data
	 * user can change picture profile using portal paage
	 */
	 
	function changePP(){
		$user_id = $this->session->userdata('user_id');
		$pic = $this->session->userdata('pp');
		if(isset($_FILES['pp'])){
			$ext = end((explode(".", $_FILES['pp']['name'])));
			$id = uniqid().'.'.$ext;
			
			# COUNT QUOTE 
			$data['jmlQuote'] = $this->quote_m->countQouteGroupUser($user_id, null);
			$data['jmlLove'] = $this->quote_m->countLikeUser($user_id, 0);
			$data['jmlThumb'] = $this->quote_m->countLikeUser($user_id, 1);

			$config = array(
				'upload_path'		=> './asset/img/members/',
				'allowed_types'		=> 'png|jpg|PNG|JPG|JPEG|jpeg',
				'max_size'			=> 1000,
				'file_name'			=> $id,
			);

			if($pic !== 'male.png' && $pic !== 'female.png'){
				$file = './asset/img/members/'.$pic;
				if(file_exists($file)){
					$clear = unlink($file);
					if($clear){
						
						$this->load->library('upload', $config);
						if(!$this->upload->do_upload('pp')){
							$data['msg'] = $this->upload->display_errors();
						}else{
							$data['msg'] = 'Profil Pic berhasil diperbaharui';
							$this->quote_m->updateData('ilmuberb_quote.users','email',$user_id, array('pic' => $id));
							$this->session->unset_userdata('pp');
							$this->session->set_userdata('pp', $id);
						}									
					}
				}else{
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('pp')){
						$data['msg'] = $this->upload->display_errors();
					}else{
						$data['msg'] = 'Profil Pic berhasil diperbaharui';
						$this->quote_m->updateData('ilmuberb_quote.users','email',$user_id, array('pic' => $id));
						$this->session->unset_userdata('pp');
						$this->session->set_userdata('pp', $id);
					}			
				}
			}else{ 
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('pp')){
					$data['msg'] = $this->upload->display_errors();
				}else{
					$data['msg'] = 'Profil Pic berhasil diperbaharui';
					$this->quote_m->updateData('ilmuberb_quote.users','email',$user_id, array('pic' => $id));
					$this->session->unset_userdata('pp');
					$this->session->set_userdata('pp', $id);
				}									
			}
			$this->load->view('public/header');								
			$this->load->view('public/profile', $data);								
			$data['q1'] = $this->quote_m->getQuote(1);
			$data['q2'] = $this->quote_m->getQuote(2);
			$data['q3'] = $this->quote_m->getQuote(3);
			$this->load->view('public/footer', $data);								
		}else{
			redirect('profile');
		}
	}

}

