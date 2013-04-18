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
					$orderID = -1;
					$search = $_GET['search']; // init var
					if (isset($_GET['catID'])){
						$catID = $_GET['catID'];
					}
					if (isset($_GET['orderID'])){
						$orderID = $_GET['orderID'];
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
					
					
					include "scripts/mysql.php";
					
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
									
								
									if(search_for($row['itemName'], $search) || search_for($row['tags'], $search)){
									
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
					
					
					
					// configure orderType
					if ($orderID == 2){
						$orderType = "itemPrice";
					} else if ($orderID == 1){
						$orderType = "10000 - itemPrice"; // gives opposite effect
					} else {
						$orderType = "itemName";
					}
					
					
					if ($catID == -1){
						$query = "SELECT * FROM `items`
						ORDER BY $orderType";
						executeResults($query, $con, $search);
					} else {
						// cat is being searched
						$query = "SELECT * FROM `items`
						WHERE `catagoryID` = '$catID'
						ORDER BY $orderType";
						executeResults($query, $con, $search);
					}
						
					
					
					
					
					
				?>
			</div>
			<div class="SearchOptions" style="width:80%; margin-left:10%; float:left">
				<h2> Search Options </h2>
				<div class="catagorySearch" Style="padding: 10px">
					<p>Want To Be More Specific!  Try Advanced Search.</p>
					<?php
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCatEmpty($query, $con);
						
						mysql_close($con);
					?>
					
					<input type="text" id="catSearch">
					<button onclick="browseWithCat()">Search</button>
				</div>
				<div class="orderBy" Style="padding: 10px">
					<p style="margin-left: 75px;">Order Search Results:
						<select style="margin-left:20px;" id="orderType">
							<option value="0">Alphabetic</option>
							<option value="1">Price - Highest To Lowest</option>
							<option value="2">Price - Lowest To Highest</option>
						</select>
					</p>
				</div>
			</div>
		</div>
	</body>
</html>