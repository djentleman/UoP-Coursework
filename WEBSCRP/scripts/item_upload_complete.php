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
				
				
				///////////////////////////////
				//------MOVE TO FILE FOR PART 2-------\\
				
				$tmpName = "none chosen";
				
				if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 

					// Temporary file name stored on the server
					$tmpName  = $_FILES['image']['tmp_name'];  
					   
					//echo $tmpName;
				}	
				
				$newfile = "img/uploads/" . $itemName . ".jpg";
				copy($tmpName, $newfile);
				
				
				//echo "<img src=$newfile></img>";
				
				
				//////////////////////////////////
			
				
				
				
				
				$query = "INSERT INTO `items` (`itemName`, `itemQuantity`,
					`itemPrice`, `sellerName`, `isNew` , 
					`tags`, `itemDescription`,  `inBasket`, `catagoryID`)
				VALUES ('$itemName', '$itemQuantity', '$price', '$sellerName', '$new', '$tags', '$description', '1', '$catagoryID')";
				//for now, all items are new, 
				executeQuery($query, $con);
				
				
				
				mysql_close($con);
				
				
				echo "<h1>Item Succesfully Uploaded</h1>";
?>