<?php
	// Php for image upload
	
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				include "mysql.php";
				
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				$response["request"] = $_REQUEST;
				$response["files"] = $_FILES;
				
				$tmpName = "none chosen";
				
				
				
				if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) { 
				
					// delete current file
					
					if (file_exists("../img/uploads/" . $itemID . ".jpg")){
						// if file exists, delete file
						unlink("../img/uploads/" . $itemID . ".jpg");
					}

					// Temporary file name stored on the server
					$tmpName  = $_FILES['file']['tmp_name'];  
					   
					//echo $tmpName;
					
					$con = mysql_connect("localhost","root");
					
					$query = "USE `tbuyer`";
					executeQuery($query, $con);
					
					$newfile = "../img/uploads/" . $itemID . ".jpg"; // ID is unique
					copy($tmpName, $newfile);
					
					
				
					$actualDir = "img/uploads/" . $itemID . ".jpg";
					
					
					if ($newfile != ""){
						$query = "UPDATE `items`
						SET `image`='$actualDir'
						WHERE `itemID`='$itemID'";
						executeQuery($query, $con);
					} // else keep it the same
					
					mysql_close($con);
					
					
				
				$response['temp dir'] = $tmpName;
				$response['new dir'] = $newfile;
				$response['Actual dir'] = $actualDir;
				}	
				
				echo json_encode($response);
?>
				