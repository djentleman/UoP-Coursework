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
						echo "<h3>The Shop Database Isn't Set Up Yet</h3>";
						echo "<h3>Click Reset Database On The CMS Panel To Fix This Problem</h3>";
					}
				}
?>