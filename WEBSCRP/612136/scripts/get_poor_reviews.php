<?php


				
				// get lowest comment value on comment table (besides -1)
				// allow for admin to reply
				// adds a new ratingless comment
				
				// eg. commenter name = 'todd', comment = 'poor product, would not buy'
				// generated reply = name = 'admin' comment = '@todd, <reply from admin>'
				
				include_once "mysql.php";
				
					function getLatestPoorComment($con){
						$query = "SELECT * FROM `comments`";
						if (!$con){
							die('Could not connect: ' . mysql_error());
						}
						if (mysql_query($query ,$con)){
							$output = (mysql_query($query ,$con));
							while($row = mysql_fetch_array($output)){
								//echo NULL == 0;
								if ($row['rating'] != -1 && $row['rating'] < 4 && $row['replied'] !== "0"){
									// not -1, valid comment
									$itemID = $row['itemID'];
									$itemName = getData("SELECT * FROM `items` WHERE `itemID` = '$itemID'", $con)[0];
									echo "<div id='poorComment'>";
									echo "<input type='hidden' id='itemID' value='$itemID'>";
									echo "<input type='hidden' id='OP' value='" . $row['posterName'] . "'>";
									echo "<input type='hidden' id='OPID' value='" . $row['commentID'] . "'>";
									echo "<p>Item Name: '" . $itemName . "'</p>";
									echo "<p>Poster Name: '" . $row['posterName'] . "'</p>";
									echo "<p style='white-space: normal; width: 60%; margin-left: 20%;'>Comment: '" . $row['commentBody'] . "'</p>";
									echo "<p>Rating: " . $row['rating'] . "/10</p>";
									
									echo "<p></p>";
									
									echo "<div id='replyForm'>";
									echo "<p>Reply:</p>";
									echo "<textarea onkeyup='return commentKeyDown()' cols='40' rows='8' id='replyText'></textarea>";
									echo "<p id='charRemaining' class='charRemaining'>1000 Characters Remaining</p>";
									echo "<p id='replyResponse'></p>";
									echo "<p></p>";
									echo "<button onclick='return replyButtonDown();'>Reply</button>";
									echo "<button onclick='return ignore();'>Ignore</button>";
									echo "</div>";
									return false;
								}
							}
							echo "There Doesn't Appear To Be Any Recent Poor Comments";	
						}
					
					}
					
					
					function getNumberOfPoorComments($con){
						$query = "SELECT * FROM `comments`";
						if (!$con){
							die('Could not connect: ' . mysql_error());
						}
						if (mysql_query($query ,$con)){
							$output = (mysql_query($query ,$con));
							$count = 0;
							while($row = mysql_fetch_array($output)){
								//echo NULL == 0;
								if ($row['rating'] != -1 && $row['rating'] < 4 && $row['replied'] !== "0"){
									$count++;
								}
							}
							return $count;
						}
						
					}
				
				
					$con = mysql_connect("localhost","root");
					$query = "USE `tbuyer`";
					executeQuery($query, $con);
					
					getLatestPoorComment($con);
					
					$pending = getNumberOfPoorComments($con);
					if ($pending != 0){
						echo "<p id='pending' class='charRemaining'>$pending Comment(s) Pending</p>";
					}
					
					echo "</div>";		
				
					mysql_close($con);
				


?>