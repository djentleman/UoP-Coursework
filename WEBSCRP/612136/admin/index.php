	<?php 
		include "adminheader.php" 
	?>
		<script src="../js/form_buy.js"></script>
		<script src="../ajax/add_stock.js"></script>
		<script src="../ajax/upload_reply.js"></script>
		
		
		
		<div class="mainContent">
			<?php
				include "../scripts/mysql.php";
				echo "<h1>Welcome To The " . $_SESSION['storeName'] . " Admin Panel</h1>";
				
				echo "<div class='lowOnStock'>";
				echo "<h3>Items Running Low On Stock</h3>";

						include "../scripts/get_stock_low.php";
						
				
				echo "</div>";
				
				
				echo "<div class='poorComments'>";
				echo "<h3>Recent Poor Reviews</h3>";
				
				// get lowest comment value on comment table (besides -1)
				// allow for admin to reply
				// adds a new ratingless comment
				
				// eg. commenter name = 'todd', comment = 'poor product, would not buy'
				// generated reply = name = 'admin' comment = '@todd, <reply from admin>'
				
					function getLatestPoorComment($con){
					$query = "SELECT * FROM `comments`";
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						$output = (mysql_query($query ,$con));
						while($row = mysql_fetch_array($output)){
							if ($row['rating'] != -1 && $row['rating'] < 4 && $row['replied'] != 0){
								// not -1, valid comment
								$itemID = $row['itemID'];
								echo "<input type='hidden' id='itemID' value='$itemID'>";
								echo "<input type='hidden' id='OP' value='" . $row['posterName'] . "'>";
								echo "<input type='hidden' id='OPID' value='" . $row['commentID'] . "'>";
								$itemName = getData("SELECT * FROM `items` WHERE `itemID` = '$itemID'", $con)[0];
								echo "<div id='poorComment'>";
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
				
				
				echo "</div>";
				
			?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		</div>
	</body>
</html>