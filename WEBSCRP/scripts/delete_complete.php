<?php
	
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						// this handles deletion of both catagories and items from the database
						
						$deleteType = $_GET['delType'];
					
						
						include "mysql.php";
						
					
						function deleteChildren($query, $con){	
							if (!$con){
								die('Could not connect: ' . mysql_error());
							}
							if (mysql_query($query ,$con)){
								$output = (mysql_query($query ,$con));
								while($row = mysql_fetch_array($output)){
									$itemID = $row['itemID'];
									
									echo $row['itemName'];
									
									$query = "DELETE FROM `items` WHERE `itemID`='$itemID' ";
									executeQuery($query, $con);
							
									$query = "DELETE FROM `comments` WHERE `itemID`='$itemID' ";
									executeQuery($query, $con);
							
									$query = "DELETE FROM `orders` WHERE `itemID`='$itemID' ";
									executeQuery($query, $con);										
								}
							}
							else{
								echo mysql_error();
							}
						}
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						
						if ($deleteType == "cat"){
							$catagoryID = $_GET['catagoryID'];
							
							$query = "SELECT * FROM `items` WHERE `catagoryID`='$catagoryID' ";
							deleteChildren($query, $con);	
							
							$query = "DELETE FROM `catagories` WHERE `catagoryID`='$catagoryID' ";
							executeQuery($query, $con);						
							
							
							
						}
						else {
							$itemID = $_GET['itemID'];
							
							$query = "DELETE FROM `items` WHERE `itemID`='$itemID' ";
							executeQuery($query, $con);
							
							$query = "DELETE FROM `comments` WHERE `itemID`='$itemID' ";
							executeQuery($query, $con);
							
							$query = "DELETE FROM `orders` WHERE `itemID`='$itemID' ";
							executeQuery($query, $con);							
							
						}
						
						
						
						mysql_close($con);
						
						
						echo "<h1> Delete Successful</h1>";
?>