<?php

				$GLOBALS = $GLOBALS+$_REQUEST;
				
				$catName = $_GET['catagoryName'];
				
				
				
				include "executeQuery.php";
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$query = "INSERT INTO `catagories` (`catagoryName`)
				VALUES ('$catName')";
				executeQuery($query, $con);
				
				
				
				
				mysql_close($con);
?>