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
								echo "<p>Comment: '" . $row['commentBody'] . "'</p>";
								echo "<p>Rating: " . $row['rating'] . "/10</p>";
								
								echo "<p></p>";
								
								echo "<div id='replyForm'>";
								echo "<p>Reply:</p>";
								echo "<textarea cols='26' rows='5' id='replyText'></textarea>";
								echo "<p></p>";
								echo "<button onclick='return uploadReply();'>Reply</button>";
								echo "<button onclick='return ignore();'>Ignore</button>";
								echo "</div>";
								echo "</div>";
								return false;
							}
						}
						echo "<div id='poorComments'>";
						echo "There Doesn't Appear To Be Any Recent Poor Comments";	
						echo "</div>";		
					}
					
					}
				
				
					$con = mysql_connect("localhost","root");
					$query = "USE `tbuyer`";
					executeQuery($query, $con);
					
					getLatestPoorComment($con);
				
					mysql_close($con);
				


?>