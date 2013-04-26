<?php
					
					$GLOBALS = $GLOBALS+$_REQUEST;
					
					include_once "mysql.php";

					
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
								if ($row['rating'] != -1){
									echo "<p>Product Rating: " . $row['rating'] . "/10</p>";
								} else {
									echo "<p>No Rating Given</p>";
								}
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
					executeQuery($query, $con);
					

					
					$query = "SELECT * FROM `comments` WHERE itemID = '$itemID'";
					fetchComments($query, $con);
					
					
					
					
					mysql_close($con);
?>