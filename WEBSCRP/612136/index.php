	<?php 
		include "header.php" 
	?>
		
		<script>	
			function shiftLeft(){
				var current = document.getElementsByClassName('currentContent')[0];
				var left = document.getElementsByClassName('leftContent')[0];
				var right = document.getElementsByClassName('rightContent')[0];
				
				current.className = "rightContent";
				left.className = "currentContent";
				right.className = "leftContent";
				
				return false;
			}
			
			function shiftRight(){
				var current = document.getElementsByClassName('currentContent')[0];
				var left = document.getElementsByClassName('leftContent')[0];
				var right = document.getElementsByClassName('rightContent')[0];
				
				current.className = "leftContent";
				right.className = "currentContent";
				left.className = "rightContent";
				
				return false;
			}
		</script>
		
		
		<div style="overflow:hidden" class="mainContent">
			<?php
			
				include "/scripts/mysql.php";
				echo "<h1>Welcome To " . $_SESSION['storeName'] . "</h1>";
				
				echo "<div class='indexItemWrap'>";
				
				echo "<div onclick='return shiftLeft()' class='leftButton'>";
				echo "<";
				echo "</div>";
				
				echo "<div  onclick='return shiftRight()' class='rightButton'>";
				echo ">";
				echo "</div>";
				
				echo "<div class='currentContent'>";
				getHighestRated();
				echo "</div>";
				
				echo "<div class='leftContent'>";
				getNewest();
				echo "</div>";
				
				echo "<div class='rightContent'>";
				getMostPopular();
				echo "</div>";
				
				echo "</div>";
				
				echo "<a href='browse.php' style='text-decoration: none;'><h3 style='color:grey'>Begin Shopping</h3></a>";
				
				function getMostPopularItemID($con){
					$query = "SELECT * FROM `orders` ORDER BY -orderQuantity";
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						$output = (mysql_query($query ,$con));
						while($row = mysql_fetch_array($output)){

							return $row['itemID'];
						}
						echo "No Orders Have Been Made Yet";
					}
						
				}
				
				function getTopResult($query, $con){
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						$output = (mysql_query($query ,$con));
						while($row = mysql_fetch_array($output)){
							
							$idParam = $row['itemID'];
							echo "<div style='width:90%;' href='browse.php' class='browseDiv'  onClick='goToBuy($idParam)'>";
							include "scripts/browseButton.php"; // renders the button
							echo "</div>";
							return false;
						}			
						echo "The Shop Has No Items";			
					}
					
						
				}
				
				
				function getHighestRated(){
					echo "<h2>Highest Rated</h2>";
					
					$con = mysql_connect("localhost","root");
					$query = "USE `tbuyer`";
					executeQuery($query, $con);
					
					$query = "SELECT * FROM `items` ORDER BY -averageRating LIMIT 1";
					getTopResult($query, $con);
					
					mysql_close($con);
				}
				
				function getMostPopular(){
					echo "<h2>What's Popular</h2>";
					
					$con = mysql_connect("localhost","root");
					$query = "USE `tbuyer`";
					executeQuery($query, $con);
					
					// get most popular item from orders table
					// only rough estimate, as array not collapsed
					$itemID = getMostPopularItemID($con);
					
					$query = "SELECT * FROM `items` WHERE `itemID` = $itemID LIMIT 1";
					getTopResult($query, $con);
					
					mysql_close($con);
				}
				
				function getNewest(){
					echo "<h2>What's New</h2>";
					
					$con = mysql_connect("localhost","root");
					$query = "USE `tbuyer`";
					executeQuery($query, $con);
					
					$query = "SELECT * FROM `items` ORDER BY -itemID LIMIT 1";
					getTopResult($query, $con);
					
					mysql_close($con);
				}
			?>
		</div>
	</body>
</html>