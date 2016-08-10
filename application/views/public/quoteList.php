<div class="cleartop"></div>
<?php if(!empty($qlist)){?>
	<div class="container-fluid">
	  <div class="row-fluid">
		<div class="span3">
			<!--profil content-->
			<div class="card people">
				<div class="card-top green">
					<?php $userAvatar = $avatar ? $avatar : $this->session->userdata('pp');?>
					<img src="<?php echo $userAvatar ? $userAvatar : 'http://portal.ilmuberbagi.id/assets/img/foto/default.png';?>" alt="<?php echo $quoter;?>">
				</div>
				<div class="card-info">
					<center><a class="title" href="<?php echo base_url().'setting/'.md5($qlist[0]['email']);?>"><?php echo $qlist[0]['first_name'].' '.$qlist[0]['last_name'];?></a></center>
					<div class="desc" align="center">"<?php echo $motivation ? $motivation : $qlist[0]['first_quote'];?>"</div>
				</div>
				<div class="card-bottom">
					<?php if(substr($qlist[0]['twitter'],0,4) == 'http'){ $link = $qlist[0]['twitter']; }else { $link = 'http://'.$qlist[0]['twitter']; }?>
					<a target="_blank" href="<?php echo $website? $website : $link;?>" class="btn"><i class="icon-coffee"></i> Mampir <?php echo $quoter;?></a>
				</div>
			</div>				
			<!--Sidebar content-->
			<?php 
				if($this->uri->segment(3) == 1){ $a = ''; $w = 'active'; $s = ''; $j = '';}
				else if($this->uri->segment(3) == 2){ $a = ''; $w = ''; $s = 'active'; $j = '';}
				else if($this->uri->segment(3) == 3){ $a = ''; $w = ''; $s = ''; $j = 'active';}
				else { $a = 'active'; $w = ''; $s = ''; $j = '';}
			?>
			<ul class="nav nav-list affix-top">
				<li class="<?php echo $a;?>"><a href="<?php echo base_url().'userQuote/'.md5($qlist[0]['email']);?>">&raquo; Semua Quote</a></li>
				<li class="<?php echo $w;?>"><a href="<?php echo base_url().'userQuote/'.md5($qlist[0]['email']).'/1';?>">&raquo; Wisdom</a></li>
				<li class="<?php echo $s;?>"><a href="<?php echo base_url().'userQuote/'.md5($qlist[0]['email']).'/2';?>">&raquo; Spirit</a></li>
				<li class="<?php echo $j;?>"><a href="<?php echo base_url().'userQuote/'.md5($qlist[0]['email']).'/3';?>">&raquo; Joke</a></li>
			</ul>
		</div>
		<div class="span9">
			<!--Body content-->
			<h2>Quote <?php echo $quoter? $quoter : $qlist[0]['first_name'];?></h2>
			<?php 
				if(!empty($message)){ ?>
					<div class="alert action">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Upss!</strong> <?php echo $message;?>.
					</div>
				<?php }
				$g = array('1' => 'W', 'S', 'J');
				$group = array('1' => 'Wisdom', 'Spirit', 'Joke');
				if(!empty($qlist)){
					foreach ($qlist as $data){
						$user = $quoter?$quoter:$data['first_name'];
						$link = base_url().'quotes/'.$data['group_name'].'/'.$data['qid'];
						$deleteLink = base_url().'removequote/'.$data['qid'];
						echo "<div class='list'>";
						if($this->session->userdata('user_id') == $qlist[0]['email']){
							echo "<a href='#myModal_".$data['qid']."' data-toggle='modal'><div class='close'>&times;</div></a>";
						}
						echo "<div class='groupLabel'>".$g[$data['qig']]."</div>";
						echo "<a href='".$link."'>".$data['isi']."</a>";
						echo "<p><span class='pull-left'>";
						echo "<span class='btn-group'><button class='btn btn-mini'><i class='icon-heart'></i></button><button class='btn btn-mini'>".count($love['_'.$data['qid']])."</button></span>";
						echo "<span class='btn-group'><button class='btn btn-mini'><i class='icon-thumbs-up'></i></button><button class='btn btn-mini'>".count($thumb['_'.$data['qid']])."</button></span>";
						echo "</span>";
						echo "<span class='pull-right'>".$user.", ".date('d/M/Y H:i:s', strtotime($data['tanggal']))."</span></p>";
						echo "</div>";?>

							<!-- Modal -->
							<div id="myModal_<?php echo $data['qid'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel">Delete Quote?</h3>
							  </div>
								<div class="modal-body">
									Anda yakin ingin menghapus Quote ini?<br/>
									Anda akan kehilangan <span class="badge badge-important"><?php echo count($love['_'.$data['qid']]);?> Loves</span> dan 
									<span class="badge badge-success"><?php echo count($thumb['_'.$data['qid']]);?> Jempol</span>
								</div>
								<?php echo form_open('removequote/'.$data['qid']);?>
								<div class="modal-footer">
									<button class="btn btn-danger">Hapus Saja</button>
									<button class="btn" data-dismiss="modal" aria-hidden="true">Jangan</button>
								</div>
								<?php echo form_close();?>
							</div>

						
						<?php 
					
					}
				}	
			?>
		</div>
	  </div>
	</div>
<?php }else{ ?>

	<!-- data kosong -->
	<div class="container-fluid">
	  <div class="row-fluid">
		<div class="span3">
			<!--profil content-->
			
			<!--Sidebar content-->
			<ul class="nav nav-list affix-top">
				<li><a href="#">&raquo; Semua Quote</a></li>
				<li><a href="#">&raquo; Wisdom</a></li>
				<li><a href="#">&raquo; Spirit</a></li>
				<li><a href="#">&raquo; Joke</a></li>
			</ul>
		</div>
		<div class="span9">
			<!--Body content-->
			<h2>Quote Kosong!</h2>
			
		</div>
	  </div>
	</div>
	


<?php }?>
<hr/>
<style>
.card.people {
  position: relative;
  display: inline-block;
  width: 100%;
  height: 300px;
  padding-top: 0;
  margin-left: 20px;
  overflow: hidden;
  vertical-align: top;
}

.card.people:first-child {
  margin-left: 0;
}

.card.people .card-top {
  position: absolute;
  top: 0;
  left: 0;
  display: inline-block;
  width: 100%;
  height: 150px;
  background-color: #ffffff;
}
</style>
