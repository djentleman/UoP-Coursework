	<?php 
		include "header.php" 
	?>
		<script src="js/form_buy.js"></script> <!-- JS for page load -->
		
		<div class="mainContent">
			<h1>Browse Results:</h1>
			<div class="browseTable">
				<?php
					//echo "'$search' was your search criteria";
					//echo "<br>";
					//echo "under catagory: $catagory";
					$catID = -1; // defaults
					$search = $_GET['search']; // init var
					if (isset($_GET['catID'])){
						$catID = $_GET['catID'];
					}
					
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
							$output = (mysql_query($query ,$con));
							$count = 0;
							while($row = mysql_fetch_array($output)){
								
								$count++;
							
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
							if ($count == 0){
								echo "<h3>No Results Found</h3>";
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
					
					
					if ($catID == -1){
						$query = "SELECT * FROM `items`
						ORDER BY itemName";
						executeResults($query, $con, $search);
					} else {
						// cat is being searched
						$query = "SELECT * FROM `items`
						WHERE `catagoryID` = '$catID'
						ORDER BY itemName";
						executeResults($query, $con, $search);
					}
						
					
					
					
					
					
				?>
			</div>
			<div class="SearchOptions" style="width:80%; margin-left:10%; float:left">
				<h2> Search Options </h2>
				<div class="catagorySearch" Style="padding: 10px">
					<p>Want To Be More Specific!  Try Category Based Searching.</p>
					<?php
						include "scripts/renderListBox.php";
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con);
						
						mysql_close($con);
					?>
					
					<input type="text" id="catSearch">
					<button onclick="browseWithCat()">Search</button>
				</div>
			</div>
		</div>
	</body>
</html>