<div class="cleartop"></div>
<div class="box-search"><?php echo $keyword; ?></div>
<?php 
	if(!empty($quotes)){ 
		$a=0; 
		foreach ($quotes as $data){
			$user = $quoter[$a] ? $quoter[$a]: $data['first_name'];
?>

			<div class="list">
				<a href="<?php echo $data['permalink'];?>"><?php echo $data['isi'];?></a>
				<div class='center mini'><?php echo $user.", ".date('d/M/Y H:i:s', strtotime($data['tanggal']));?>"</div>
			</div>

<?php 		$a++; 
		}
	}else{ 
		echo "<div class='flabel'>Tidak ditemukan, Silakan cek kata kunci yang Anda masukkan!</div>";
	}
?>

<hr/>