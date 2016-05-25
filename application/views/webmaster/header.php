<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
	  <?php 
		if($this->uri->segment(1) == 'quotes'){
			if(!empty($quote)){
				$title = 'Quote Berbagi : '.$quote[0]['isi'].' - By : '.$quote[0]['first_name'];
				$author = $quote[0]['first_name'].' '.$quote[0]['last_name'];
				$keywords = str_replace(' ',',',$title);
			}else{
				$title = 'Quote Berbagi';
				$author = $title;
				$keywords = str_replace(' ',',',$title);
			}
		}else if($this->uri->segment(1) == 'pengembang'){
			$title = 'Pengembang Quote Berbagi';
			$author = $title;
			$keywords = str_replace(' ',',',$title);		
		}else{
			$title = 'Quote Berbagi';
			$author = $title;
			$keywords = str_replace(' ',',',$title);
		}
	  ?>
      <title><?php echo $title;?></title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Berbagi Inspirasi dengan Quote, Quote Berbagi, Inspiratif, karena semua orang bisa menginspirasi, ilmu berbagi, IBF">
      <meta name="keywords" content="<?php echo $keywords;?>">
      <meta name="author" content="<?php echo $author;?>">
	  <!-- meta name="google-translate-customization" content="b4e48374e559f597-26dce238d53b324c-g88c861905cc97311-17"></meta -->

      <!-- Le styles -->
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
      <link href="<?php echo base_url().'asset/css/bootplus.css';?>" rel="stylesheet">
      <link href="<?php echo base_url().'asset/css/bootplus-responsive.css';?>" rel="stylesheet">
      <link href="<?php echo base_url().'asset/css/font-awesome.min.css';?>" rel="stylesheet">
      <link href="<?php echo base_url().'asset/css/custom.css';?>" rel="stylesheet">
	  
    <script src="<?php echo base_url().'asset/js/jquery.js';?>"></script>

 	<link rel="shortcut icon" href="<?php echo base_url().'asset/img/iconQB.png';?>" type="image/png">
	<link rel="icon" href="ico.png" type="image/png">
   <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url().'asset/js/html5shiv.js';?>"></script>
    <![endif]-->
        
  </head>

  <body>

	<div class="container">
		<div class="navbar navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container">
			  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="brand" href="<?php echo base_url().'post';?>"><img src="<?php echo base_url().'asset/img/logoHome.png';?>"  width="200" title="Click here to Quote" alt="Quote Berbagi"></a>
			  <img class="brand pull-left cari" width="30" src="<?php echo base_url().'asset/img/v.png';?>" style="cursor:pointer" title="Search Quote" alt="Search Quote">
			  <?php 
				# active link
				if($this->uri->segment(1) == 'about'){ $aa = 'active'; $ha = ''; $la = ''; }
				else if($this->uri->segment(1) == 'login'){ $aa = ''; $ha = ''; $la = 'active'; }
				else if($this->uri->segment(1) == ''){ $ha = 'active'; $aa = ''; $la = ''; }
				else { $aa = ''; $ha = ''; $la = ''; }
			  ?>
			  <div class="nav-collapse collapse">
				
				<form class="navbar-form pull-left custom-search" style="display:none" onSubmit="return cek()" action="<?php echo base_url().'search';?>" method="GET">
					<input type="search" name="q" id="cari" class="input-xlarge" placeholder="Search Quote">
				</form>
				<ul class="nav pull-right">
				  <li class="<?php echo $ha;?>"><a href="<?php echo base_url();?>"><i class="icon-home"></i> Home</a></li>
				  <li class="<?php echo $aa;?>"><a href="<?php echo base_url().'about';?>">About</a></li>
				  <?php if($this->session->userdata('logStatus') == 1){?>
					  <li class="dropdown">
						<a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">
						<?php echo $this->session->userdata('name');?> <b class="caret"></b></a>
						<ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop2">
						  <li><a role="menuitem" tabindex="-1" href="<?php echo base_url().'profile';?>">Profile</a></li>
						  <li><a role="menuitem" tabindex="-1" href="<?php echo base_url().'userQuote/'.md5($this->session->userdata('user_id'));?>">Quote Anda</a></li>
						  <li class="divider"></li>
						  <li><a role="menuitem" tabindex="-1" href="<?php echo base_url().'setting/'.md5($this->session->userdata('user_id'));?>">Setting</a></li>
						  <?php if($this->session->userdata('user_id') == 'sabbana.returns@yahoo.com'){?>
						  <li><a role="menuitem" tabindex="-1" href="<?php echo base_url().'webmaster';?>">Webmaster</a></li>
						  <?php } ?>
						  <li><a role="menuitem" tabindex="-1" href="<?php echo base_url().'logout';?>">Logout</a></li>
						</ul>
					  </li>
				 <?php }else{?>
				  <li class="<?php echo $la;?>"><a href="<?php echo base_url().'login';?>">Login</a></li>
				 <?php } ?>
				  <!-- li>
						<ul class="translation-links">
						  <li><a href="#" class="spanish" data-lang="Spanish">Spanish</a></li>
						  <li><a href="#" class="german" data-lang="German">German</a></li>
						</ul>
						<div id="google_translate_element" class="btn"></div><script type="text/javascript">
							function googleTranslateElementInit() {
							  new google.translate.TranslateElement({pageLanguage: 'id', includedLanguages: 'ar,en,id,ja,nl', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
							}
						</script>
						<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				  </li -->
				</ul>
			  </div><!--/.nav-collapse -->
			</div>
		  </div>
		</div>
		<script>
			$(function(){
				$('.cari').click(function(){
					$('.custom-search').fadeIn('fast');
					$('.custom-search input').focus();
				});
				$('.custom-search input').mouseout(function(){
					$('.custom-search').fadeOut(400);
					$('.cari').show(400);
				});
			});
			function cek(){
				var id = $('#cari').val();
				if(id == ''){return false;}
				else { return true; }
			}
		</script>
