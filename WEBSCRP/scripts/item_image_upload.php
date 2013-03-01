			<?php
				
				
				//$image = $_POST['image'];
				
				
				include "executeQuery.php";
			
				function getHighestID($con){ // gets the item ID to be worked with
					
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query("SELECT `itemID` FROM `items`" ,$con)){
						// returns highest ID
						$output = (mysql_query("SELECT `itemID` FROM `items`" ,$con));
						$currentHighest = 0;
						while($row = mysql_fetch_array($output)){
							if ($row['itemID'] > $currentHighest){
								$currentHighest = $row['itemID'];
							}
				
							
						}
						return $currentHighest;
					}
					else{
						echo mysql_error();
					}
				}

				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$itemID = getHighestID($con);
				
				header("x-debug3: '$itemID'");
			
				$tmpName = "none";
				
				if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 

					// Temporary file name stored on the server
					$tmpName  = $_FILES['image']['tmp_name'];  
					   
					//echo $tmpName;
				}	
				
				
				header("x-debug1: '$tmpName'");
				
				header("x-files: " . json_encode($_FILES));
				header("x-post: " . json_encode($_POST));
				
			
				if ($tmpName != "none"){
					$newfile = $_SERVER['DOCUMENT_ROOT'] . "/cw/img/uploads/" . $itemID . ".jpg"; // ID is unique
					copy($tmpName, $newfile);
				}
				else {
					$newfile = "none"; // no image
				}
				
				
				header("x-debug2: '$newfile'");
				
				
				
				
				
				
				
				$query = "UPDATE `items` 
						SET `image`='$newfile' 
						WHERE `itemID`='$itemID'";
				executeQuery($query, $con);
				
				
				mysql_close($con);
				
			?>
			