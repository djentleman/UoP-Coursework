<?php
	// accepts an item ID, and returns all item information from the Database.
	
	
	
	include "mysql.php";
	
	

	$con = mysql_connect("localhost","root");
	
	$query = "USE `tbuyer`";
	executeQuery($query, $con);
	
	//$itemID = $_GET['itemID'];
	$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
	$dataArray = getData($query, $con);
	

	// assign variables to array elements
	if (isset($dataArray[0])){

		$itemName = $dataArray[0];
		$itemQuantity = $dataArray[1];
		$itemPrice = $dataArray[2];
		$sellerName = $dataArray[3];
		$isNew = $dataArray[4];
		$tags = $dataArray[5];
		$itemDescription = $dataArray[6];
		$image = $dataArray[7];
		$searchRelevance = $dataArray[8];
		$catagoryID = $dataArray[9];
		$catagoryName = getCatName($catagoryID, $con);
		$averageRating = $dataArray[10];

	} else {

		$itemName = "404: Item Not Found :(";
		$itemQuantity = "";
		$itemPrice = "";
		$sellerName = "";
		$isNew = "";
		$tags = "";
		$itemDescription ="";
		$image = "";
		$searchRelevance = "";
		$catagoryID = "";
		$catagoryName = "";
		$averageRating = "";
	}
	
	
	mysql_close($con);
?>