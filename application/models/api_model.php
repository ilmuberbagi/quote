<?php

class Api_model extends CI_Model
{

	function countQouteGroup($kat = null){
		if($kat == null){
			$sql = "select count(*) as jml from ilmuberb_quote.quote";
		}else{
			$sql = "select count(*) as jml from ilmuberb_quote.quote where qig = '$kat'";
		}
		foreach ($this->db->query($sql)->result_array() as $data);
		return $data['jml'];
	
	}
	
	function getQuote($kat){
		$jml = $this->countQouteGroup($kat);
		$get = rand(0, $jml-1);
		$sql = "select a.qid, a.qig, a.isi, a.tanggal, b.first_name, b.last_name, concat('http://www.quote.ilmuberbagi.or.id/asset/img/members/',b.pic) as pic, 
				c.group_name, concat('http://www.quote.ilmuberbagi.or.id/quotes/', concat(concat(c.group_name,'/'), a.qid)) as permalink 
				from ilmuberb_quote.quote a left join ilmuberb_quote.users b on a.email = b.email 
				left join ilmuberb_quote.quote_group c on a.qig = c.qig where a.qig = '$kat' and a.status = 1 limit $get, 1";
		return $this->db->query($sql)->result_array();
	}
	
	
	function getQuoteLimit($kat, $limit){
		$sql = "select a.qid, a.qig, a.isi, a.tanggal, b.first_name, b.last_name,concat('http://www.quote.ilmuberbagi.or.id/asset/img/members/',b.pic) as pic, 
				c.group_name, concat('http://www.quote.ilmuberbagi.or.id/quotes/', concat(concat(c.group_name,'/'), a.qid)) as permalink 
				from ilmuberb_quote.quote a left join ilmuberb_quote.users b on a.email = b.email 
				left join ilmuberb_quote.quote_group c on a.qig = c.qig where a.qig = '$kat' and a.status = 1 limit 0, $limit";
		return $this->db->query($sql)->result_array();
	}
	
	function getQuoteUser($kat = null, $email, $limit){
		$id = md5($email);
		if($kat == null){
			$sql = "select a.qid, a.qig, a.isi, a.tanggal, b.first_name, b.last_name,concat('http://www.quote.ilmuberbagi.or.id/asset/img/members/',b.pic) as pic, 
				c.group_name, concat('http://www.quote.ilmuberbagi.or.id/quotes/', concat(concat(c.group_name,'/'), a.qid)) as permalink 
				from ilmuberb_quote.quote a left join ilmuberb_quote.users b on a.email = b.email 
				left join ilmuberb_quote.quote_group c on a.qig = c.qig 
				where md5(a.email) = '$id' and a.status = 1 limit 0, $limit";
		}else{
			$sql = "select a.qid, a.qig, a.isi, a.tanggal, b.first_name, b.last_name,concat('http://www.quote.ilmuberbagi.or.id/asset/img/members/',b.pic) as pic, 
				c.group_name, concat('http://www.quote.ilmuberbagi.or.id/quotes/', concat(concat(c.group_name,'/'), a.qid)) as permalink 
				from ilmuberb_quote.quote a left join ilmuberb_quote.users b on a.email = b.email 
				left join ilmuberb_quote.quote_group c on a.qig = c.qig 
				where a.qig = '$kat' and md5(a.email) = '$id' and a.status = 1 limit 0, $limit";
		}
		return $this->db->query($sql)->result_array();
	}
	
}