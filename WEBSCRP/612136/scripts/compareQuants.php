<?php
	// get quantity
	// compare with quanToBuy
	// return callback (0 or 1)
	
	include "mysql.php";
	
	$itemID = $_GET['itemID'];
	$quanToCompare = $_GET['quantityToCheck'];
	
	$con = mysql_connect("localhost","root"); // will be querying item IDs
	$query = "USE `tbuyer`";
	executeQuery($query, $con); // use tbuyer
	
	$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
	$dataArray = getData($query, $con);
	
	$itemQuan = $dataArray[1];
	
	if (!is_numeric($quanToCompare)){
		echo "1";
		die();
	}
	if ($quanToCompare < 0){
		echo "1";
		die();
	}
	if ($itemQuan >= $quanToCompare){
		echo "0"; // callback
		die();
	} else {
		echo "1"; // callback
		die();
	}
	
	
?>
