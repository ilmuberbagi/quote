<?php
	$random = '';
	for($a=0; $a<5; $a++){
		$text = rand(0,9);
		$random .= $text;
	}
	echo $random;
?>