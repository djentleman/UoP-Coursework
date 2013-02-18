<?php
	// upload complete script
	
	// abadoning ajax upheval for this script (for now)
	
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				//$itemName = $_GET['itemName'];
				//$itemQuantity = $_GET['itemQuantity'];
				//$price = $_GET['price'];
				//$sellerName = $_GET['sellerName'];
				//$new = $_GET['new'];
				//$tags = $_GET['tags'];
				//$catagoryID = $_GET['catagoryID'];
				//$description = $_GET['description'];
				
				include "executeQuery.php";
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				
	
				
				
				$query = "INSERT INTO `items` (`itemName`, `itemQuantity`,
					`itemPrice`, `sellerName`, `isNew` , 
					`tags`, `itemDescription`,  `inBasket`, `catagoryID`)
				VALUES ('$itemName', '$itemQuantity', '$price', '$sellerName', '$new', '$tags', '$description', '1', '$catagoryID')";
				//for now, all items are new, 
				executeQuery($query, $con);
				
				
				
				mysql_close($con);
				
				
				echo "<h1>Item Succesfully Uploaded</h1>";
?>