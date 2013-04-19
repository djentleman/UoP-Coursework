			<?php
				

				$response["request"] = $_REQUEST;
				$response["files"] = $_FILES;
				
				include "mysql.php";
			
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
						$response["SQL_Error"] = mysql_error();
					}
				}

				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$itemID = getHighestID($con);
				
			
				$tmpName = "none";
				
				if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) { 

					// Temporary file name stored on the server
					$tmpName  = $_FILES['file']['tmp_name'];  
					   
					//echo $tmpName;
				}	
				
				
			
				if ($tmpName != "none"){
					$newfile = $_SERVER['DOCUMENT_ROOT'] . "/612136/img/uploads/" . $itemID . ".jpg"; // ID is unique
					copy($tmpName, $newfile);
				}
				else {
					$newfile = "none"; // no image
				}
				
				
				$actualDir = "/612136/img/uploads/" . $itemID . ".jpg";
				
				$response['temp dir'] = $tmpName;
				$response['new dir'] = $newfile;
				$response['Actual dir'] = $actualDir;
				
				$query = "UPDATE `items` SET image='$actualDir' WHERE itemID='$itemID'";
				executeQuery($query, $con);
				
				
				mysql_close($con);
				
				
				echo json_encode($response);
				
			?>
			