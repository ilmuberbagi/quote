<div class="cleartop"></div>
<?php if(!empty($user)){?>
	<div class="container-fluid">
	  <div class="row-fluid">
		<div class="span3">
			<!--profil content-->
			<div class="card people">
				<div class="card-top green">
					<img src="<?php echo $avatar ? $avatar : 'http://portal.ilmuberbagi.id/assets/img/foto/default.png';?>" alt="">
				</div>
				<div class="card-info">
					<center><a class="title" href="#" align="center"><?php echo $user[0]['first_name'].' '.$user[0]['last_name'];?></a></center>
					<div class="desc" align="center">"<?php echo $user[0]['first_quote'];?>"</div>
				</div>
				<div class="card-bottom">
					<?php if(substr($user[0]['twitter'],0,4) == 'http'){ $link = $user[0]['twitter']; }else { $link = 'http://'.$user[0]['twitter']; }?>
					<a href="<?php echo $link;?>" target="_blank" class="btn"><i class="icon-coffee"></i> Mampir <?php echo $user[0]['first_name'];?></a>
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
				<li class="<?php echo $a;?>"><a href="<?php echo base_url().'userQuote/'.md5($user[0]['email']);?>">&raquo; Semua Quote</a></li>
				<li class="<?php echo $w;?>"><a href="<?php echo base_url().'userQuote/'.md5($user[0]['email']).'/1';?>">&raquo; Wisdom</a></li>
				<li class="<?php echo $s;?>"><a href="<?php echo base_url().'userQuote/'.md5($user[0]['email']).'/2';?>">&raquo; Spirit</a></li>
				<li class="<?php echo $j;?>"><a href="<?php echo base_url().'userQuote/'.md5($user[0]['email']).'/3';?>">&raquo; Joke</a></li>
			</ul>
		</div>
		<div class="span9">
			<!--Body content-->
			<h2>Setting Akun</h2>
			<table class="table table-stripet default">
			<tr class="emailDefault">
				<th width="200">Email</th>
				<td><?php echo $user[0]['email'];?></td>
				<td class="btnEmail" style="cursor:pointer">Sunting</td>
			</tr>
			<tr class="fbDefault">
				<th>Nama Depan</th>
				<td><?php echo $user[0]['first_name'];?></td>
				<td class="btnEmail" style="cursor:pointer">Sunting</td>
			</tr>
			<tr class="emailDefault">
				<th>Nama Belakang</th>
				<td><?php echo $user[0]['last_name'];?></td>
				<td class="btnEmail" style="cursor:pointer">Sunting</td>
			</tr>
			<tr class="emailDefault">
				<th>Halaman</th>
				<td><?php echo $user[0]['twitter'];?></td>
				<td class="btnEmail" style="cursor:pointer">Sunting</td>
			</tr>
			<tr class="emailDefault">
				<th>Tanggal Gabung</th>
				<td><?php echo $user[0]['date_reg'];?></td>
				<td class="btnEmail" style="cursor:pointer">Sunting</td>
			</tr>
			<tr class="emailDefault">
				<th>Profil Quote</th>
				<td><pre><?php echo $user[0]['first_quote'];?></pre></td>
				<td class="btnEmail" style="cursor:pointer">Sunting</td>
			</tr>
			</table>
			<!-- form -->
			<?php echo form_open('updateakun');?>
			<table class="table table-stripet form" style="display:none">
			<tr class="emailDefault">
				<th>Email</th>
				<td><input type="email" name="email" value="<?php echo $user[0]['email'];?>" class="input-xlarge" readonly></td>
			</tr>
			<tr class="fbDefault">
				<th>Nama Depan</th>
				<td><input type="text" name="fname" value="<?php echo $user[0]['first_name'];?>" class="input-xlarge" required></td>
			</tr>
			<tr class="emailDefault">
				<th>Nama Belakang</th>
				<td><input type="text" name="lname" value="<?php echo $user[0]['last_name'];?>" class="input-xlarge"></td>
			</tr>
			<tr class="emailDefault">
				<th>Halaman</th>
				<td><input type="text" name="twitter" value="<?php echo $user[0]['twitter'];?>" class="input-xlarge"></td>
			</tr>
			<tr class="emailDefault">
				<th>Tanggal Gabung</th>
				<td><input type="text" name="tanggal" value="<?php echo $user[0]['date_reg'];?>" class="input-xlarge" readonly></td>
			</tr>
			<tr class="emailDefault">
				<th>Profil Quote</th>
				<td><textarea name="fquote" rows="5" class="input-xlarge"><?php echo $user[0]['first_quote'];?></textarea></td>
			</tr>
			<tr class="emailDefault">
				<th></th>
				<td>
					<input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-primary">
					<input type="reset" name="batal" value="Batal" class="btn tutup">
				</td>
			</tr>
			</table>
			<?php echo form_close();?>
		</div>
	  </div>
	</div>
<?php }?>
<hr/>
<script type="text/javascript">
	$(function(){
		$('.btnEmail').click(function(){
			$('.default').fadeOut(100);
			$('.form').slideDown("slow");
		});
		$('.tutup').click(function(){
			$('.default').fadeIn(1000);
			$('.form').hide(100);
		});
	});
</script>
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
