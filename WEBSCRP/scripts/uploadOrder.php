<?php
	// upload order
	
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				$itemID = $_GET['itemID'];
				$orderQuantity = $_GET['orderQuantity'];
				$buyerName = $_GET['buyerName'];
				$buyerAddress = $_GET['buyerAddress'];
				$buyerPostcode = $_GET['buyerPostcode'];
				$buyerEmail = $_GET['buyerEmail'];
				$buyerPhoneNo = $_GET['buyerPhoneNo'];
				

				include "executeQuery.php";
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				
	
				
				
				$query = "INSERT INTO `orders` (`orderQuantity`, `buyerName`,
					`buyerAddress`, `buyerPostcode`, `buyerEmail` , 
					`buyerPhoneNo`, `itemID`) 
				VALUES ('$orderQuantity', '$buyerName', '$buyerAddress', '$buyerPostcode', '$buyerEmail', '$buyerPhoneNo', '$itemID')";
				executeQuery($query, $con);
				
				
				
				mysql_close($con);
				
				
				echo "<h1>Order Succesfully Uploaded</h1>";
?>