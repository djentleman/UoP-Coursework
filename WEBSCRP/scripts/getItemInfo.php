<?php
	// accepts an item ID, and returns all item information from the Database.
	
	include "executeQuery.php";
	
	function getData($query, $con){	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if (mysql_query($query ,$con)){
			$output = (mysql_query($query ,$con));
			while($row = mysql_fetch_array($output))
				// there should only be one row
				return [$row['itemName'], $row['itemQuantity'], $row['itemPrice'],
									$row['sellerName'], $row['isNew'], $row['tags'], 
									$row['itemDescription'], $row['image'], $row['inBasket'], 
									$row['catagoryID']]; // array of everything 
				
		}
		else{
			echo mysql_error();
		}
		return [null];
	}
	
	$con = mysql_connect("localhost","root");
	
	$query = "USE `tbuyer`";
	executeQuery($query, $con);
	
	$itemID = $_GET['itemID'];
	$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
	$dataArray = getData($query, $con);
	

	// assign variables to array elements
	
	$itemName = $dataArray[0];
	$itemQuantity = $dataArray[1];
	$itemPrice = $dataArray[2];
	$sellerName = $dataArray[3];
	$isNew = $dataArray[4];
	$tags = $dataArray[5];
	$itemDescription = $dataArray[6];
	$image = $dataArray[7];
	$inBasket = $dataArray[8];
	$catagoryID = $dataArray[9];
	
	
	mysql_close($con);
?>