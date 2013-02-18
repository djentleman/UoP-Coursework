			<?php
				
				
				
				include "executeQuery.php";
			
			
				
			
			
				$tmpName = "none chosen";
				
				if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 

					// Temporary file name stored on the server
					$tmpName  = $_FILES['image']['tmp_name'];  
					   
					//echo $tmpName;
				}	
				
				
				header("x-debug1: '$tmpName'");
				
				$newfile = "img/uploads/" . $itemName . ".jpg";
				copy($tmpName, $newfile);
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$query = "INSERT INTO `items` (`image`)
				VALUES ('$newFile')";
				//for now, all items are new, 
				executeQuery($query, $con);
			?>
			