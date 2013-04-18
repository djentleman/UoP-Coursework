<?php
	
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						// this handles deletion of both catagories and items from the database
						
						$deleteType = $_GET['delType'];
					
						
						include "mysql.php";
						
					
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						
						if ($deleteType == "cat"){
							$catagoryID = $_GET['catagoryID'];
							$query = "DELETE FROM `catagories` WHERE `catagoryID`='$catagoryID' ";
						}
						else {
							$itemID = $_GET['itemID'];
							$query = "DELETE FROM `items` WHERE `itemID`='$itemID' ";
						}
						
						executeQuery($query, $con);
						
						
						mysql_close($con);
						
						
						echo "<h1> Delete Successful</h1>";
?>