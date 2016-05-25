<code>
	$datapost = http_build_query(
		array(
			'api_kode' => 1001,
			'api_datapost' => array(rand(1,3), 5)
		)
	);
	$option = array(
		'http'	=> array(
			'method'	=> 'POST',
			'header'	=> 'Content-type:application/x-www-form-urlencoded',
			'content'	=> $datapost
		)
	);
	$stream = stream_context_create($option);
	$result = json_decode(file_get_contents(URL_API.'getQuote', false, $stream), true);
	</code>
<hr/>
<?php
	$datapost = http_build_query(
		array(
			'api_kode' => 1002,
			'api_datapost' => array('','sabbana.returns@yahoo.com', 50)
		)
	);
	$option = array(
		'http'	=> array(
			'method'	=> 'POST',
			'header'	=> 'Content-type:application/x-www-form-urlencoded',
			'content'	=> $datapost
		)
	);
	$stream = stream_context_create($option);
	$result = json_decode(file_get_contents(URL_API.'getQuote', false, $stream), true);
	foreach ($result as $data){
		echo $data['isi'].'<br/>'.$data['first_name'].' - '.$data['tanggal'].'<hr/>';
	}
?>
