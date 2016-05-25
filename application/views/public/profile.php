<div class="cleartop"></div>

<div class="card hovercard center">
   <!-- img src="<?php echo base_url().'asset/img/cover_default.png';?>" alt=""/ -->
   <div class="alert alert-danger"><h2 class='profile'>Profil Anda</h2><p class="profile">Anda Luar Biasa</p><br/></div>
   <div class="avatar">
      <a href="#myModal" data-toggle="modal">
		<img src="<?php echo $avatar ? $avatar:'http://portal.ilmuberbagi.id/assets/img/foto/default.png';?>" alt="<?php echo $this->session->userdata('name');?>" title="Ganti Foto Profil"/></a>
   </div>
   <div class="info">
      <div class="title">
         <?php echo $this->session->userdata('name');?>
      </div>
      <div class="desc"><?php echo $this->session->userdata('name');?></div>
      <div class="desc"><?php echo $this->session->userdata('logStatus') == 1? '<span class="label label-success">Aktif</span>':'';?></div>
   </div>
   <div class="bottom">
		<a class="btn" href="<?php echo base_url().'userQuote/'.md5($this->session->userdata('user_id'));?>"><?php echo $jmlQuote;?> Quotes</a>
		<button class="btn"><?php echo $jmlLove;?> Loves</button>
		<button class="btn"><?php echo $jmlThumb;?> Thumbs</button>
   </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Ganti Foto Profil Anda</h3>
  </div>
	<div class="modal-body">
		<div class="alert alert-info">
			<b>Informasi!</b>
			<p>Anda bisa mengubah profile foto Anda melalui halaman portal</p>
		</div>
	</div>
	<div class="modal-footer">
		<a href="http://localhost/ibf/adminportal" class="btn btn-primary">Masuk Portal</a>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>

<hr/>