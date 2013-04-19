<?php

				$GLOBALS = $GLOBALS+$_REQUEST;
				
				$catagoryName = $_GET['catagoryName'];
				$catagoryID = $_GET['catagoryID'];
				
				include "mysql.php";
				

				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				
				$query = "UPDATE `catagories`
				SET `catagoryName`='$catagoryName'
				WHERE `catagoryID`='$catagoryID'";
				executeQuery($query, $con);
				
				
				mysql_close($con);
?>