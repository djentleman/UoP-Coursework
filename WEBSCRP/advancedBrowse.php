<?php 
		include "header.php" 
	?>
		
		<div class="mainContent">
			<?php
				
				$GLOBALS = $GLOBALS+$_REQUEST;
				//echo "'$search' was your search criteria";
				//echo "<br>";
				//echo "under catagory: $catagory";
				
				
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
				
				function executeResults($query, $con, $isName, $nameSearch, $isTags, $tagSearch, $isCatagory, $catagoryID){
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						echo "<h2>Browse Results:</h2>";
						$output = (mysql_query($query ,$con));
						while($row = mysql_fetch_array($output)){
						
						
							if ($isName == "true"){
								if ($nameSearch != ""){
								
								
									
								
									//echo "search is not empty";
									
								
									if(search_for($row['itemName'], $nameSearch)){
										echo "<p>item name: " . $row['itemName'];
										echo "</p>";
										echo "<form action='buy.php' method='post'>";
										
										
										include "scripts/browseButton.php"; // defines the variables
										
										//variables to pass
										// TODO pass the rest
										
										
									}
								}
								else{
									//if the search is empty, dump it all
									echo "<p>item name: " . $row['itemName'];
									echo "</p>";
									echo "<form action='buy.php' method='post'>";
									
									include "scripts/browseButton.php"; // defines the variables
									
								}
							}
							
							if ($isTags == "true"){
								if ($tagSearch != ""){
								
									//echo "search is not empty";
									
									if(search_for($row['tags'], $tagSearch)){
										echo "<p>item name: " . $row['itemName'];
										echo "</p>";
										echo "<form action='buy.php' method='post'>";
										
										
										include "scripts/browseButton.php"; // defines the variables
										
										//variables to pass
										// TODO pass the rest
									}
								}
								// no need to dump everything
							}
							
							if ($isCatagory == "true"){
								
								//echo "search is not empty";
									
								if(search_for($row['catagoryID'], $catagoryID)){
									echo "<p>item name: " . $row['itemName'];
									echo "</p>";
									echo "<form action='buy.php' method='post'>";
									
									
									include "scripts/browseButton.php"; // defines the variables
										
									//variables to pass
									// TODO pass the rest
								}
								
							// no need to dump everything
							}
							
							
							
							
							
							
						}
						
					}
					else{
						echo mysql_error();
					}
					
				}
				
				
				// stops crash due to undefined variables
				
				//--------------------------------------------
				
				if (isset($isName) == false){
					$isName = "false";
				}
				if (isset($isTags) == false){
					$isTags = "false";
				}
				if (isset($isCatagory) == false){
					$isCatagory = "false";
				}
				
				//-------------------------------------------
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				
				
				//old query for search not being 0
				// "SELECT * FROM `items` WHERE `itemName`='$search'"
				//if you leave the query black it returns all
				$query = "SELECT * FROM `items`";
				executeResults($query, $con, $isName, $nameSearch, $isTags, $tagSearch, $isCatagory, $catagoryID);
				
				
				
				mysql_close($con);
				
				
			?>
		</div>
	</body>
</html>