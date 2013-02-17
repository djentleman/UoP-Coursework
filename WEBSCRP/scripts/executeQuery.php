<?php
//Execute Query Function
//UPDATE, DELETE & CREATE all use this code

function executeQuery($query, $con){
					
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
?>