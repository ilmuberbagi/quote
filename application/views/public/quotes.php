	<script>
		function cekSession(){
			var sess = '<?php echo $this->session->userdata('user_id');?>';
			if(sess == ''){
				$('.action').css({'display':'block'});
				return false;
			}else{
				return true;
			}
		}
		$(function(){
			$('.fb').click(function(){
				$('.spanfb').fadeToggle('1000');
				$('.spantw').css({'display':'none'});
			});
			$('.tw').click(function(){
				$('.spantw').fadeToggle('1000');
				$('.spanfb').css({'display':'none'});
			});
		});
	</script>
	<!-- Jumbotron -->
	<?php $this->load->view('public/lib');?>
	<div class="jumbotron">
		<div class="alert action">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Upss!</strong> Anda harus login terlebih dahulu untuk memberikan <b>Love</b> atau <b>Jempol</b> pada Quote ini.
		</div>
		<?php if(!empty($quote)){?>
		<div class="label-group"><a href="<?php echo base_url().'search?q='.$quote[0]['group_name'];?>"><?php echo ucwords(strtolower($quote[0]['group_name']));?></a></div>
		<img src="<?php echo $avatar;?>" width="50" height="50" class="img-circle" title="<?php echo $quote[0]['first_name'];?>">

		<?php $g = array(1=>'wisdom','spirit','joke'); ?>
			<h2><a data-toggle="tooltip" title="" data-original-title="Klik untuk melihat quote lainnya" class="quote" href="<?php echo base_url().'quotes/'.$g[$quote[0]['qig']];?>"><font face="garamond" size="10" color="#d84a38">"</font><?php echo $quote[0]['isi'];?><font face="garamond" size="10" color="#d84a38">"</font></a></h2>
			<p><?php echo "Quoter : <b><a href='".base_url('userQuote/'.md5($quote[0]['email']))."'>".$quoter."</a></b>, Tanggal : ".date('d/M/Y , H:i:s', strtotime($quote[0]['tanggal']));?></p>
			
			<p class="">
				<?php if($isLove == 1){ $btnLove = 'btn-danger'; $lovetitle = 'Gajadi Love'; }else {$btnLove = ''; $lovetitle = 'Kasih Love'; } ?>
				<?php if($isThumb == 1){ $btnThumb = 'btn-success'; $thumbtitle = 'Gajadi Like'; }else { $btnThumb = ''; $thumbtitle = 'Kasih Like'; } ?>
				<span class="btn-group">
					<a onclick="return cekSession()" title="<?php echo $lovetitle;?>" class="btn custom <?php echo $btnLove;?>" 
					href="<?php echo base_url().'action/love/'.$quote[0]['qid'];?>"><i class="icon-heart"></i></a>
					<a href="#lover" class="btn custom" data-toggle="modal"><?php echo count($love);?></a>
				</span>
				<span class="btn-group">
					<a onclick="return cekSession()" title="<?php echo $thumbtitle;?>" class="btn custom <?php echo $btnThumb;?>" href="<?php echo base_url().'action/thumb/'.$quote[0]['qid'];?>">
					<i class="icon-thumbs-up"></i></a>
					<a href="#thumbs" class="btn custom" data-toggle="modal"><?php echo count($thumb);?></a>
				</span>
				<span class="btn-group">

					<a class="btn custom" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url().'quotes/'.$g[$quote[0]['qig']].'/'.$quote[0]['qid'];?>','facebook-share-dialog','width=626,height=436'); return false;" href="javascript:void(0);">
					<span class="icon-facebook"></span></a>
					
					<a class="btn custom" onclick="window.open('http://twitter.com/intent/tweet?text=<?php echo base_url().'quotes/'.$g[$quote[0]['qig']].'/'.$quote[0]['qid'];?>','twitter-share-dialog','width=626,height=436'); return false;" href="javascript:void(0);">
					<span class="icon-twitter"></span></a>
					
					<a class="btn custom" onclick="window.open('https://plus.google.com/share?url=<?php echo base_url().'quotes/'.$g[$quote[0]['qig']].'/'.$quote[0]['qid'];?>','twitter-share-dialog','width=626,height=436'); return false;" href="javascript:void(0);">
					<span class="icon-google-plus"></span></a>
					
					<a class="btn custom" href="whatsapp://send?text=<?php echo $quote[0]['isi'].' '.current_url();?>">
					<span class="icon-share-alt"></span></a>
				</span>
			</p>
			<!-- Modal LOVERS -->
			<div id="lover" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Quote Lover!</h3>
			  </div>
			  <div class="modal-body">
					<?php if(!empty($love)){ echo "<ul>"; foreach ($love as $a){ if($a['first_name'] != ''){ $name = $a['first_name'].' '.$a['last_name']; }else{ $name = 'Mr. Lovers'; }?>
						<li><?php echo $name;?><br/><code><?php echo $a['date_log'];?></code></li>
					<?php } echo "</ul>"; }else{ echo "<span class='label label-warning'>Upss... Quote belum ada yang ngeLove</span>";} ?>
			  </div>
			</div>
			<!-- Modal THUMBS -->
			<div id="thumbs" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Quote Likers!</h3>
			  </div>
			  <div class="modal-body">
					<?php if(!empty($thumb)){ echo "<ul>"; foreach ($thumb as $a){ if($a['first_name'] != ''){ $name = $a['first_name'].' '.$a['last_name']; }else{ $name = 'Mr. Lovers'; }?>
						<li><?php echo $name;?><br/><code><?php echo $a['date_log'];?></code></li>
					<?php } echo "</ul>"; }else{ echo "<span class='label label-warning'>Upss... Quote belum ada yang ngeLike</span>";} ?>
			  </div>
			</div>

			<div class="time"><div style="font-size:0.8em">Waktu Baca Sekitar</div><i class="icon-time"></i> &nbsp;&nbsp;<?php echo estimate_time_read($quote[0]['isi']);?></div>
			<hr>

		<?php }else{
			echo "<h2>Belum ada Quote!</h2><p>Ayo gabung, dan berbagi Quote disini!</p>";
			echo '<a class="btn btn-large btn-danger" href='.base_url('post').'>Quote of the day</a>';
		} ?>
	</div>
	
	<style>
		.action{ display:none; }
		.modal li{
			text-align:left;
			list-style:none;
		}
	</style>