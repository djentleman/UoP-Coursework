<?php
				$GLOBALS = $GLOBALS+$_REQUEST;
				

				$OPID = $_GET['OPID'];
				
				
				include "mysql.php";
				
		
				
				$con = mysql_connect("localhost","root");
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$query = "UPDATE `comments`
				SET `replied`='0'
				WHERE `commentID`='$OPID'";
				executeQuery($query, $con);
				
				mysql_close($con);
?>