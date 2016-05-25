<?php

class Quote_m extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	/**
	 *  since we integrated data member 
	 *  we didn't use this model anymore 
	 *  for auth, we using api 
	 */
	 
	function auth($user, $pass){
		$password = md5($pass);
		$sql = "select *, 'quote' as sistem from users where email = '$user' and password = '$password'";
		$data = $this->db->query($sql)->result_array();
		if(!empty($data)){
			return $data;
		}else{
			$password = sha1($pass);
			$sql2 = "select b.email, a.nama as first_name, ' ' as last_name, '1' as status, tahun as date_reg, 'ib' as sistem, b.tanggal_lahir as birth_date, testimonial as first_quote, b.foto as pic from user a
					left join biodata b on a.id = b.user_id where b.email = '$user' and password = '$password'";
			$data = $this->db->query($sql2)->result_array();
			if(!empty($data)){
				#print_r($data); die();
				$pic = str_replace('.png','', str_replace('.jpg','',str_replace('images/foto/IB_','',$data[0]['pic'])));
				$url = 'http://member.ilmuberbagi.or.id';
				$dataAkun = array(
					'email'			=> $data[0]['email'],
					'password'		=> md5($pass),
					'first_name'	=> $data[0]['first_name'],
					'last_name'		=> $data[0]['last_name'],
					'pic'			=> 'ib.jpg',
					'status'		=> 1,
					'twitter'		=> $url,
					'first_quote'	=> $data[0]['first_quote'],
				);
				// $signup = $this->saveData('users', $dataAkun);
				return $data;
			}else{
				return false;
			}
		}
	}
	
	function getDataMember(){
		$sql = "select * from user a left join biodata b on a.id = b.user_id";
		return $this->ib->query($sql)->result_array();
	}
	
	function getSingleData($table, $key, $value){
		$sql = "select a.qid, a.qig, a.isi, a.tanggal, b.first_name, b.last_name, 
				concat('http://www.quote.ilmuberbagi.or.id/asset/img/members/',b.pic) as pic, 
				c.group_name, concat('".site_url()."quotes/', concat(concat(c.group_name,'/'), a.qid)) as permalink, a.email from $table a left join users b on a.email = b.email 
				left join quote_group c on a.qig = c.qig where a.$key = '$value' and a.status = 1";
		return $this->db->query($sql)->result_array();
	}
	
	function getCurrentUser($id){
		$sql = "select * from users where md5(email) = '$id'";
		return $this->db->query($sql)->result_array();
	}
	
	function updateAkun($id, $data){
		$this->db->where('md5(email)', $id);
		return $this->db->update('users', $data);
	}
	
	function getAllData($table, $sort, $type){
		if($sort == '' && $type == ''){
			$sql = "select * from $table";
		}else{
			$sql = "select * from $table order by $sort $type";
		}
		return $this->db->query($sql)->result_array();
	}

	function getAllUsersLimit($limit, $start){
		$sql = "select * from users order by date_reg desc ";
		$sqlLimit = $this->db->_limit($sql, $limit, $start);
		return $this->db->query($sqlLimit)->result_array();
	}

	function getAllQuotesLimit($limit, $start){
		$sql = "select *, a.status as sts from quote a left join users b on a.email = b.email
				left join quote_group c on a.qig = c.qig order by a.tanggal desc ";
		$sqlLimit = $this->db->_limit($sql, $limit, $start);
		return $this->db->query($sqlLimit)->result_array();
	}

	function countQouteGroup($kat = null){
		if($kat == null){
			$sql = "select count(*) as jml from quote where status = 1";
		}else{
			$sql = "select count(*) as jml from quote where qig = '$kat' and status = 1";
		}
		foreach ($this->db->query($sql)->result_array() as $data);
		return $data['jml'];
	
	}
	
	function countQouteGroupUser($user, $kat = null){
		if($kat == null){
			$sql = "select count(*) as jml from quote where email = '$user'";
		}else{
			$sql = "select count(*) as jml from quote where qig = '$kat' and email = '$user'";
		}
		foreach ($this->db->query($sql)->result_array() as $data);
		return $data['jml'];
	
	}
	
	function countLikeUser($user, $type){
		$sql = "select count(*) as jml from likes where qid in (select qid from quote where ltype = '$type' and email = '$user')";
		foreach ($this->db->query($sql)->result_array() as $data);
		return $data['jml'];
	}
	
	function countData($table){
		$sql = "select count(*) as jml from $table ";
		foreach ($this->db->query($sql)->result_array() as $data);
		return $data['jml'];
	}
	
	function searchQuote($key){
		$keyword = $this->db->escape_like_str($key);
		$sql = "select a.qid, a.qig, a.isi, a.tanggal, b.first_name, b.last_name, concat('http://www.quote.ilmuberbagi.or.id/asset/img/members/',b.pic) as pic, 
				c.group_name, concat('".site_url()."quotes/', concat(concat(c.group_name,'/'), a.qid)) as permalink, a.email
				from quote a left join users b on a.email = b.email 
				left join quote_group c on a.qig = c.qig where a.isi like '%$keyword%' or b.first_name like '$keyword%' or c.group_name = '$keyword' 
				and a.status = 1";
		return $this->db->query($sql)->result_array();
	}
	
	
	function getQuote($kat){
		$jml = $this->countQouteGroup($kat);
		$get = rand(0, $jml-1);
		$sql = "select a.qid, a.qig, a.isi, a.tanggal, b.first_name, b.last_name, concat('http://www.quote.ilmuberbagi.or.id/asset/img/members/',b.pic) as pic, 
				c.group_name, concat('http://www.quote.ilmuberbagi.or.id/quotes/', concat(concat(c.group_name,'/'), a.qid)) as permalink, a.email
				from quote a left join users b on a.email = b.email 
				left join quote_group c on a.qig = c.qig where a.qig = '$kat' and a.status = 1 limit $get, 1";
		return $this->db->query($sql)->result_array();
	}

	function saveData($table, $data){
		return $this->db->insert($table, $data);
	}
	
	function deleteQuote($id){
		$sql = "delete from likes where qid = '$id'";
		$sql2 = "delete from quote where qid = '$id'";
		$this->db->query($sql);
		return $this->db->query($sql2);
	}
	
	function updateData($table, $key, $id, $data){
		$this->db->where($key, $id);
		return $this->db->update($table, $data);
	}
	
	function batalLike($user, $qid, $type){
		$sql = "delete from likes where email = '$user' and qid = '$qid' and ltype='$type'";
		return $this->db->query($sql);
	}
	
	function getUserQuote($id, $type){
		if($type == null){
			$sql = "select *, a.email as email from quote a left join users b on a.email = b.email
				left join quote_group c on a.qig = c.qig 
				where md5(a.email) = '$id' order by a.tanggal desc";
		}else{
			$sql = "select *, a.email as email from quote a left join users b on a.email = b.email
				left join quote_group c on a.qig = c.qig 
				where md5(a.email) = '$id' and a.qig = '$type' order by a.tanggal desc";		
		}
		return $this->db->query($sql)->result_array();
	}
	
	function islike($user, $qid, $type){
		$cek = "select * from likes where ltype = '$type' and email = '$user' and qid = '$qid'";
		$data = $this->db->query($cek)->result_array();
		if(!empty($data)){
			return 1;
		}else { return 0; }
	}
	
	function getLikeOfQuote($qid, $type){
		$sql = "select a.qid, a.date_log, b.first_name, b.last_name, a.email 
				from likes a left join users b on a.email = b.email 
				where a.qid = '$qid' and a.ltype = '$type' order by a.date_log desc";
		return $this->db->query($sql)->result_array();
	}
	
	function aktivationAccount($email){
		$sql = "update users set status = 1 where md5(email) = '$email'";
		return $this->db->query($sql);
	}
	
	function blockQuote($qid){
		$sql = "update quote set status = 0 where qid = '$qid'";
		return $this->db->query($sql);
	}
	
	function activeQuote($qid){
		$sql = "update quote set status = 1 where qid = '$qid'";
		return $this->db->query($sql);
	}
	
	function blockuser($id){
		$sql = "update users set status = 0 where md5(email) = '$id'";
		return $this->db->query($sql);
	}
		
	function activateuser($id){
		$sql = "update users set status = 1 where md5(email) = '$id'";
		return $this->db->query($sql);
	}
	
}
