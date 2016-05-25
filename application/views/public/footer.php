	<!-- Example row of columns -->
	<?php if($this->uri->segment(1) !== 'pengembangan'){?>
      <div class="row-fluid">
        <div class="span4">
          <h2>Wisdoms</h2>
          <p><?php if(!empty($q1)){ echo '"'.$q1[0]['isi'].'"<div class="medium">'.$q1[0]['first_name'].', '.date('d / M / Y H:i:s', strtotime($q1[0]['tanggal'])).'</div>';};?></p>
          <p><a class="btn" href="<?php echo base_url().'quotes/wisdom';?>">View details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Spirits</h2>
          <p><?php if(!empty($q2)){ echo '"'.$q2[0]['isi'].'"<div class="medium">'.$q2[0]['first_name'].', '.date('d / M / Y H:i:s', strtotime($q2[0]['tanggal'])).'</div>';};?></p>
          <p><a class="btn" href="<?php echo base_url().'quotes/spirit';?>">View details &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Jokes</h2>
          <p><?php if(!empty($q3)){ echo '"'.$q3[0]['isi'].'"<div class="medium">'.$q3[0]['first_name'].', '.date('d / M / Y H:i:s', strtotime($q3[0]['tanggal'])).'</div>';};?></p>
          <p><a class="btn" href="<?php echo base_url().'quotes/joke';?>">View details &raquo;</a></p>
        </div>
      </div>
	<?php } ?>
      <hr>

	  <div class="footer">
       Copyright &copy; 2015 Quote Berbagi. All Rights Reserved<br/>
	   <div class="span5"><a href="<?php echo base_url().'pengembang';?>">Pengembang </a> | <a href="<?php echo base_url().'ketentuan';?>">Ketentuan </a> | <a href="<?php echo base_url().'bantuan';?>">Bantuan </a> | <a href="<?php echo base_url().'signup';?>">Sign Up </a>
			<br/>
			<a href="https://www.facebook.com/ilmuberbagi" class="btn"><i class="icon-facebook"></i></a>
			<a href="https://twitter.com/ilmuberbagi" class="btn"><i class="icon-twitter"></i></a>
			<a href="https://www.youtube.com/user/ilmuberbagi" class="btn"><i class="icon-youtube"></i></a>
	   
	   </div>
		<div class="span3 pull-right" style="text-align:center">dipersembahkan oleh:<br/>
		<a href="http://www.ilmuberbagi.or.id" target="_blank"><img src="<?php echo base_url().'asset/img/ib.png';?>" width="200"></a>
		</div>
      </div>

    </div> 
	<style>.span4{text-align:center;}</style>
	
    <script src="<?php echo base_url().'asset/js/bootstrap-transition.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-alert.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-modal.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-dropdown.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-scrollspy.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-tab.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-tooltip.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-popover.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-button.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-collapse.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-carousel.js';?>"></script>
    <script src="<?php echo base_url().'asset/js/bootstrap-typeahead.js';?>"></script>

  </body>
</html>
