<?php 
	header('Content-Type: application/json');
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL,"https://api.quotable.io/random");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);
	echo $result;
?>