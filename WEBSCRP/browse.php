	<?php 
		include "header.php" 
	?>
		
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
						echo "<h2>Browse Results:</h2>";
						$output = (mysql_query($query ,$con));
						while($row = mysql_fetch_array($output))
						
						
						
						
						{
							if ($search != ""){
							
							
								
							
								//echo "search is not empty";
								
								//$bool = search_for($row['itemName'], $search);
								//echo "$bool";
								
							
								if(search_for($row['itemName'], $search)){
									
									
									include "scripts/browseButton.php"; // defines the variables
									
									//variables to pass
									// TODO pass the rest
									
									
								}
							}
							else{
								//if the search is empty, dump it all
								
								include "scripts/browseButton.php"; // defines the variables
								
							}
						}
						echo "<br>";
						echo "<br>";
						echo "<p> not finding what you're looking for?";
						echo "<p> try <a href='advancedSearch.php'>'advanced search'</a></p> ";
						
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