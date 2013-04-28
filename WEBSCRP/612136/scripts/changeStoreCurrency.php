<?php
	// updates currency symbol
	
	session_start();
	
	$code = $_GET['code'];
	$convertPrices = $_GET['convert']; // boolean

	// change symbol
	
	if ($code == "GBP"){
		$sym = "&pound;";
	} else if ($code == "USD"){
		$sym = "&dollar;";
	} else if ($code == "EUR"){
		$sym = "&euro;";
	} else {
		$sym = "&yen;";
	}
	
	$filepath = "../assets/currency.txt";
	file_put_contents ($filepath, $sym);
	
	$_SESSION['currency'] = $sym;
	
	// convert prices here
	
	
	
	echo "Current Currency: " . $_SESSION['currency'];

?>