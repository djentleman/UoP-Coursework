<?php
	include "executeQuery.php";
	include "getData.php";
	
	
	$itemID = $_GET['itemID'];
	$quanToAdd = $_GET['stockToAdd'];
	
	
	// get current stock
	
	$con = mysql_connect("localhost","root"); // will be querying item IDs
	$query = "USE `tbuyer`";
	executeQuery($query, $con); // use tbuyer
	
	$query = "SELECT * FROM `items` WHERE `itemID` = $itemID";
	$dataArr = getData($query, $con);
	
	$dataArr[1];
	
	$newStock = $quanToAdd + $dataArr[1];
	
	$query = "UPDATE `items`
	SET `itemQuantity`='$newStock'
	WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
	
?>