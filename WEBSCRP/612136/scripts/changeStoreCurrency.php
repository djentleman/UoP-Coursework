<?php
	// updates currency symbol
	
	session_start();
	
	$code = $_GET['code'];
	$convertPrices = $_GET['convert']; // boolean
	$old = $_GET['old']; // code odl currency

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
	
	
	
	echo $_SESSION['currency'];
	
	
	function getConversionRate($from, $to){
		// uses GBP as a stepping stone
		
		/*
		rates:
		format:
			<from> => <to> = <rate>
		to GBP:
			USD => GBP = 0.65
			EUR => GBP = 0.84
			JPY => GBP = 0.006
		from GBP:
			GBP => USD = 1.55
			GBP => EUR = 1.19
			GBP => JPY = 115.76
		*/
		
		if ($to == $from){
			return 1;
		}
		if ($to == "GBP"){
			if ($from == "USD"){
				return 0.65;
			} else if ($from == "EUR"){
				return 0.84;
			} else if ($from == "JPY"){
				return 0.006;
			}
		} else if ($from == "GBP"){
			if ($to == "USD"){
				return 1.54;
			} else if ($to == "EUR"){
				return 1.19;
			} else if ($to == "JPY"){
				return 166.6;
			}
		} else {
			// neither to or from gbp
			// for instance, EUR => USD
			// would be EUR => GBP => USD
			// which can eb calculated by (EUR => GBP) * (GBP => USD)
			$toGBP = getConversionRate($from, "GBP");
			$fromGBP = getConversionRate("GBP", $to);
			return $toGBP * $fromGBP;
		}
	}
	
	function doConversion($con, $conversionRate, $code){
		$query = "SELECT * FROM `items`";
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if (mysql_query($query ,$con)){
			$output = (mysql_query($query ,$con));
			while($row = mysql_fetch_array($output)){
				$price = $row['itemPrice'] * $conversionRate;
				if ($code == "JPY"){
					$price = intval($price);
				}
				$itemID = $row['itemID'];
				
				$newQuery = "UPDATE `items`
				SET `itemPrice`='$price'
				WHERE `itemID`='$itemID'";
				
				executeQuery($newQuery, $con);
			}						
		}
		else{
			echo mysql_error();
		}
	}
	
	$conversionRate = getConversionRate($old, $code);
	
	// we have the rate, now to do the conversions
	
	include "mysql.php";
	
	// iterate through every item, multiple the price by the conversion rate
	// if yen, convert to integer, else do nothing
	
	$con = mysql_connect("localhost","root");
	$query = "USE `tbuyer`";
	executeQuery($query, $con);
	
	doConversion($con, $conversionRate, $code);
	
	mysql_close($con);

?>