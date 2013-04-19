<?php
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				$posterName = $_GET['posterName'];
				$comment = $_GET['comment'];
				$itemID = $_GET['itemID'];
				
				
				echo "<h2> Comment Upload Successful </h2>";
				
				include "mysql.php";
				
				
				
				if ($posterName == ""){
					$posterName = "Anon";
				}
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$query = "INSERT INTO `comments` (`posterName`, `commentBody`, `itemID`)
				VALUES ('$posterName', '$comment', '$itemID')";
				executeQuery($query, $con);
				
				
				
				
				
				
				mysql_close($con);
?>