<div class="cleartop"></div>
<div class="box-search"><?php echo $keyword; ?></div>
<?php if(!empty($quotes)){ foreach ($quotes as $data){?>

	<div class="list">
		<a href="<?php echo $data['permalink'];?>"><?php echo $data['isi'];?></a>
		<div class='center mini'><?php echo $data['first_name'].", ".date('d/M/Y H:i:s', strtotime($data['tanggal']));?>"</div>
	</div>

<?php }}else{ echo "<div class='flabel'>Tidak ditemukan, Silakan cek kata kunci yang Anda masukkan!</div>";}?>

<hr/>