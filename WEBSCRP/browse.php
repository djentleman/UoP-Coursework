	<?php 
		include "header.php" 
	?>
		<script src="js/form_buy.js"></script> <!-- JS for page load -->
		
		<div class="mainContent">
			<?php
				//echo "'$search' was your search criteria";
				//echo "<br>";
				//echo "under catagory: $catagory";
				$search = $_GET['search']; // init var
				
				// ordering
				
				function length($str){
					$i = 0;
					while (isset($str{$i})){
						$char = $str{$i};
						$i++; 
					}
					return $i;
				}
				
				
			
				include "scripts/search_for.php"; // search function for browse
				
				//for now, no catagories are returned.
				
				
				include "scripts/executeQuery.php";
				
				function executeResults($query, $con, $search){
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						echo "<h1>Browse Results:</h1>";
						$output = (mysql_query($query ,$con));
						while($row = mysql_fetch_array($output))
						
						
						
						
						{
							if ($search != ""){
							
							
								
							
								//echo "search is not empty";
								
								//$bool = search_for($row['itemName'], $search);
								//echo "$bool";
								
							
								if(search_for($row['itemName'], $search)){
								
									$idParam = $row['itemID'];
								
									
									echo "<div class='browseDiv'  onClick='goToBuy($idParam)'>";
									include "scripts/browseButton.php"; // defines the variables
									echo "</div>";
									
									//variables to pass
									// TODO pass the rest
									
									
								}
							}
							else{
								//if the search is empty, dump it all
								
								
								$idParam = $row['itemID'];
								
								echo "<div class='browseDiv' onClick='goToBuy($idParam)'>";
								include "scripts/browseButton.php"; // defines the variables
								echo "</div>";
								
							}
						}	
					}
					else{
						echo mysql_error();
					}
					
				}
				
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				//old query for search not being 0
				// "SELECT * FROM `items` WHERE `itemName`='$search'"
				//if you leave the query black it returns all
				
				
				
				// ADD AN ORDER BY BUTTON HERE!
				
				
				
				$query = "SELECT * FROM `items`
				ORDER BY itemName";
				executeResults($query, $con, $search);
					
				
				
				
				
				
				mysql_close($con);
			?>
		</div>
	</body>
</html>