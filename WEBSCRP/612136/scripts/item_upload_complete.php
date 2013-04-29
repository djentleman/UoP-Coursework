<?php
	// upload complete script
	
	// abadoning ajax upheval for this script (for now)
	
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				$itemName = $_GET['itemName'];
				$itemQuantity = $_GET['itemQuantity'];
				$price = $_GET['price'];
				$sellerName = $_GET['sellerName'];
				$new = $_GET['new'];
				$tags = $_GET['tags'];
				$catagoryID = $_GET['catagoryID'];
				$description = $_GET['description'];
				
				
				echo $new;
				
				include "mysql.php";
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				
	
				
				
				$query = "INSERT INTO `items` (`itemName`, `itemQuantity`,
					`itemPrice`, `sellerName`, `isNew` , 
					`tags`, `itemDescription`,  `searchRelevance`, `catagoryID`, `averageRating`) 
				VALUES ('$itemName', '$itemQuantity', '$price', '$sellerName', '$new', '$tags', '$description', '0', '$catagoryID', '-1')";
				// 0 for search relevance
				// -1 for average rating
				executeQuery($query, $con);
				
				
				
				mysql_close($con);
				
				
				echo "<h1>Item Succesfully Uploaded</h1>";
?>