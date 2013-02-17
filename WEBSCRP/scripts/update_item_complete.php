<?php

				$GLOBALS = $GLOBALS+$_REQUEST;
				
				include "scripts/executeQuery.php";
				
				
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
				
				
				if ($sellerName != ""){
					$query = "UPDATE `items`
					SET `sellerName`='$sellerName'
					WHERE `itemID`='$itemID'";
					executeQuery($query, $con);
				} // else keep it the same
				
				
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
				
				
				$tmpName = "none chosen";
				
				if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 

					// Temporary file name stored on the server
					$tmpName  = $_FILES['image']['tmp_name'];  
					   
					//echo $tmpName;
					
					$newfile = "img/uploads/" . $itemName . ".jpg";
					copy($tmpName, $newfile);
					
					
					if ($newfile != ""){
						$query = "UPDATE `items`
						SET `image`='$newfile'
						WHERE `itemID`='$itemID'";
						executeQuery($query, $con);
					} // else keep it the same
				}	
				
				
				
				
				mysql_close($con);
				
				
				echo "<h1>Item Succesfully Updated</h1>";
?>