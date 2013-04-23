<?php
					
					$GLOBALS = $GLOBALS+$_REQUEST;
					

					function executeQ($query, $con){ //executeQuery
					// needs tidying.
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						//echo "Command Executed.";
					}
					else{
						echo mysql_error();
					}
					}

					
					function fetchComments($query, $con){
						
						if (!$con){
							die('Could not connect: ' . mysql_error());
						}
						if (mysql_query($query ,$con)){
						//	echo "Command Executed.";
							
							$output = (mysql_query($query ,$con));
							while($row = mysql_fetch_array($output)){
							// this is the printed comment section
							
								echo "<p> Poster Name: " . $row['posterName'] . "</p>";
								echo "<p> " . $row['commentBody'] . "</p>";
								echo "<br>";
							}
								
						}
						else{
							echo mysql_error();
						}
					}
					
					$con = mysql_connect("localhost","root");
				
				
					$query = "USE `tbuyer`";
					executeQ($query, $con);
					

					
					$query = "SELECT * FROM `comments` WHERE itemID = '$itemID'";
					fetchComments($query, $con);
					
					
					
					
					mysql_close($con);
?>