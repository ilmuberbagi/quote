<div style="width:90%; margin:auto; text-align:center; font-family:arial" id="mini">
	<div>
		<?php $this->load->view('public/lib');?>
		<div class="label-group"><?php echo ucwords(strtolower($quote[0]['group_name']));?></div>
		<img src="<?php echo $quote[0]['pic'];?>" width="50" height="50" class="img-circle" title="<?php echo $quote[0]['first_name'];?>">
		<?php $g = array(1=>'wisdom','spirit','joke'); if(!empty($quote)){?>
		<h2><a class="quote" href="<?php echo base_url().'quotes/'.$g[$quote[0]['qig']];?>" target="_blank"><font face="garamond" color="#d84a38">"</font><?php echo $quote[0]['isi'];?><font face="garamond" color="#d84a38">"</font></a></h2>
		<p><?php echo "Quoter : <b><a target='_blank' href='".base_url('userQuote/'.md5($quote[0]['email']))."'>".$quote[0]['first_name']."</a></b>, Tanggal : ".date('d/M/Y , H:i:s', strtotime($quote[0]['tanggal'])); } ?></p>
	</div>
	<div class="time"><div style="font-size:0.8em">Waktu Baca Sekitar</div><i class="icon-time"></i> &nbsp;&nbsp;<?php echo estimate_time_read($quote[0]['isi']);?></div>
</div>
<style>
a{
	text-decoration:none;
	color:#222;
	font-weight:normal;
}
</style>