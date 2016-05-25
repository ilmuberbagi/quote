<?php

	function estimate_time_read($quote){
	
		$count_words = explode(' ', $quote);
		$period = (count($count_words)/3);
		$result = $period;
		return round($result,2).' Sec.';
	
	}



?>