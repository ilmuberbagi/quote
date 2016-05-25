<style>
	#slide1, #slide2, #slide3{
		height:300px;
		background-position:right;
		background-repeat:no-repeat;
		background-image:url(asset/img/slide1.png);
	}
	#slide2{background-image:url(asset/img/slide2.png);}
	#slide3{background-image:url(asset/img/slide3.png);}
</style>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '549313041839125',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
	<!-- Jumbotron -->
	<div class="jumbotron">
		
		<!-- corrusel -->
		<div id="myCarousel" class="carousel slide">
		  <ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		  </ol>
		  <!-- Carousel items -->
		  <div class="carousel-inner">
			<div class="active item">
				<!-- item 1 -->
				<div id="slide1"></div>
			</div>
			<div class="item">
				<!-- item 1 -->
				<div id="slide2"></div>
			</div>
			<div class="item">
				<!-- item 1 -->
				<div id="slide3"></div>
			</div>
		  </div>
		  <!-- Carousel nav -->
		  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>		

	</div>

	<hr>
	<div class="container-fluid">
	  <div class="row-fluid">
		<div class="span3">
		 <!--Sidebar content-->
			<ul class="nav nav-list bs-docs-sidenav affix">
				<li><a href="#required">&raquo; Requirement</a></li>
				<li><a href="#api">&raquo; API</a></li>
				<li><a href="#ss">&raquo; Server Side</a></li>
				<li><a href="#embeded">&raquo; Client Side</a></li>
			</ul>
		</div>
		<div class="span9">
		  <!--Body content-->
			<h1 id="sekilas">» Pengembang Quote Berbagi</h1>
			<h3 id="required">Requirement</h3>
			<p>
				<img src="<?php echo base_url().'asset/img/code.png';?>" width="300" class="pull-left"> Untuk menggunakan dan mengeshare atau menyertakan Quote Berbagi di halaman (website/blog) Anda tidak memerlukan persyaratan khusus. Anda bebas menyertakan Quote-quote ini untuk menjadikan halaman Anda lebih Awesome.</p><p>Jika dikemudian hari, Website/Blog Anda dinyatakan tidak layak menggunakan/menyertakan quote kami karena hal tertentu, maka kami berhak memblokir quote kami tanpa melalui pemberitahuan terlebih dahulu.
			</p>
			<h3 id="api">API (Application Programming Interface)</h3>
			<p>
				Kami menyediakan API yang dapat digunakan oleh developer untuk mengambil quote-quote yang ada di Quote Berbagi. Adapun kami menyediakan dalam 2 bentuk atau metode/cara, yaitu: Server Side dan Embeded/Client Side.
			</p>
			<h3 id="ss">Server Side (Script PHP)</h3>
			<p>
				Masukkan Code/Script berikut pada server Client Anda.
				<ol>
					<li>Gunakan <code>'api_kode' => 1000</code> dan <code>'api_datapost'=>array([1/2/3])</code> untuk mengambil Satu Quote berdasarkan group yang diinginkan. 1 untuk group <i>Wisdom</i>, 2 untuk <i>Spirit</i> dan 3 untuk <i>Joke</i>. Atau Anda bisa mengacak ketiganya dengan menggunakan fungsi <code>rand(1,3)</code>.
					</li>
					<li>Gunakan <code>'api_kode' => 1001</code> dan <code>'api_datapost'=>array($group, $limit)</code> untuk mengambil beberapa Quote berdasarkan jumlah yang diinginkan (limit tertentu).
					</li>
					<li>Gunakan <code>'api_kode' => 1002</code> dan <code>'api_datapost'=>array($group, $email, $limit)</code> untuk mengambil Quote Anda (Jika telah bergabung dengan Quote Berbagi) berdasarkan jumlah yang diinginkan (limit tertentu). Dengan cara ini memungkinkan untuk mengikuti (follow) quote user tertentu yang Anda inginkan dengan memasukkan alamat email user yang bersangkutan.
					</li>
				</ol>
				<p>Berikut Script yang bisa Anda Copy dan Custome</p>
				<pre style="color:red">
&lt;?php
	$postdata = http_build_query(
		array(
			'api_kode'	=> 1000, 
			'api_datapost' => array(rand(1,3))
		)
	);
	$opts = array('http' =>
	array(
		'method'  => 'POST',
		'header'  => 'Content-type: application/x-www-form-urlencoded',
		'content' => $postdata
	));
	$context  = stream_context_create($opts);
	$result = json_decode(file_get_contents(URL_API.'getQuote', false, $context),true);		
	return $result;
?>
				</pre>
			</p>
			<p>
				Script di atas akan menghasil nilai balik (kembalian/return) data berupa <code>array</code>. Anda bisa mengambil/menampilkan hasil data sesuai dengan keinginan Anda. Berikut hasil Script di atas:
			</p>
			<pre>

Array
(
    [0] => Array
        (
            [qid] => 44
            [qig] => 3
            [isi] => Pantang pulang sebelum bawa anak orang. #diaryperantau
            [tanggal] => 2015-01-21 04:58:26
            [first_name] => Sho
            [last_name] => Tozuro
            [pic] => http://www.quote.ilmuberbagi.or.id/asset/img/members/54bd10967d61e.png
            [group_name] => joke
            [permalink] => http://www.quote.ilmuberbagi.or.id/quotes/joke/44
        )

)
			</pre>
			
			<h3 id="embeded">Client Side (Tag HTML)</h3>
			<p>
				Cara ini cukup mudah, namun hanya bisa mengambil Satu Quote secara random untuk semua group. Cukup dengan menggunakan tag <code>iframe</code> quote sudah bisa anda nikmati.
				<code>&lt;iframe src="http://quote.ilmuberbagi.or.id/sharequote" width="500" height="500" scrolling="auto"&gt;&lt;/iframe&gt;</code>
			</p>
			
			<p>
				<div class="fb-like" data-href="http://quote.ilmuberbagi.or.id/pengembang" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</p>
		</div>
	  </div>
	</div>
	
	<hr/>
	
	<script>
		$(window).scroll(function() {
			var height = $(window).scrollTop();
			if(height  >= 500) {
				$('.nav-list').css({'top':'100px'});
			}else if (height < 300){
				$('.nav-list').animate({top:'500px'});			
			}
		});
	</script>
