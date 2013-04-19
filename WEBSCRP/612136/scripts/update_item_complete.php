<?php

				$GLOBALS = $GLOBALS+$_REQUEST;
				
				// $_GET requests
				$itemID = $_GET['itemID'];
				$itemName = $_GET['itemName'];
				$itemQuantity = $_GET['itemQuantity'];
				$itemPrice = $_GET['itemPrice'];
				$sellerName = $_GET['sellerName'];
				$isNew = $_GET['isNew'];
				$tags = $_GET['tags'];
				$catagoryID = $_GET['catagoryID'];
				$description = $_GET['description'];
				
				if ($isNew == "true"){
					$isNew = 0;
				} else {
					$isNew = 1;
				}
				
				echo $isNew;
				
				include "mysql.php";
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				
				
				if ($itemName != ""){
					$query = "UPDATE `items`
					SET `itemName`='$itemName'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
				if ($itemQuantity != ""){
					$query = "UPDATE `items`
					SET `itemQuantity`='$itemQuantity'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
				if ($itemPrice != ""){
					$query = "UPDATE `items`
					SET `itemPrice`='$itemPrice'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
				
				
				
				if ($sellerName != ""){
					$query = "UPDATE `items`
					SET `sellerName`='$sellerName'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
				$query = "UPDATE `items`
				SET `isNew`='$isNew'
				WHERE `itemID`='$itemID'";
				executeQuery($query, $con);
				// else keep it the same
				
				
				// ignore isNew for now
				// do it later on
				
				
				if ($tags != ""){
					$query = "UPDATE `items`
					SET `tags`='$tags'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
				if ($catagoryID != ""){
					$query = "UPDATE `items`
					SET `catagoryID`='$catagoryID'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
				if ($description != ""){
					$query = "UPDATE `items`
					SET `itemDescription`='$description'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
				
				
				
				mysql_close($con);
				
				
				echo "<h1>Item Succesfully Updated</h1>";
?>