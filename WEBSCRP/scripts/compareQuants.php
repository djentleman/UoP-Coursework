<?php
	// get quantity
	// compare with quanToBuy
	// return callback (0 or 1)
	
	include "executeQuery.php";
	include "getData.php";
	
	$itemID = $_GET['itemID'];
	$quanToCompare = $_GET['quantityToCheck'];
	
	$con = mysql_connect("localhost","root"); // will be querying item IDs
	$query = "USE `tbuyer`";
	executeQuery($query, $con); // use tbuyer
	
	$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
	$dataArray = getData($query, $con);
	
	$itemQuan = $dataArray[1];
	
	if ($itemQuan >= $quanToCompare){
		echo "0"; // callback
	} else {
		echo "1"; // callback
	}
	
	
?>
