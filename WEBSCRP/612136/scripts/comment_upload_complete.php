<?php
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				$posterName = $_GET['posterName'];
				$comment = $_GET['comment'];
				$rating = $_GET['rating'];
				$itemID = $_GET['itemID'];
				
				
				echo "<h2> Comment Upload Successful </h2>";
				
				include "mysql.php";
				
				
				
				if ($posterName == ""){
					$posterName = "Anon";
				}
				
				
				function getAverageRating($con){	
					$itemID = $_GET['itemID'];
					$query = "SELECT * FROM `comments` WHERE `itemID` = $itemID";
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						$output = (mysql_query($query ,$con));
						$count = 0;
						$total = 0;
						while($row = mysql_fetch_array($output)){
							$rating = $row['rating'];
							if ($rating != -1){
								// rating is valid
								$count++;
								$total += $rating;
							}
						}
						$mean = $total / $count;
						return $mean;
				
					}
					else{
						echo mysql_error();
					}
					return -1; // no average rating;
				}
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$query = "INSERT INTO `comments` (`posterName`, `commentBody`, `rating`, `itemID`)
				VALUES ('$posterName', '$comment', '$rating', '$itemID')";
				executeQuery($query, $con);
				
				$mean = getAverageRating($con);
				
				
				$query = "UPDATE `items`
				SET `averageRating`='$mean'
				WHERE `itemID`='$itemID'";
				executeQuery($query, $con);
				
				// update average rating of item
				
				
				mysql_close($con);
?>