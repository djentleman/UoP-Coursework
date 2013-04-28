	<?php 
		include "header.php";
	?>
		<script src="js/form_buy.js"></script> <!-- JS for page load -->
		
		<div class="mainContent">
			<h1>Browse Results:</h1>
			<div class="browseTable">
				<?php
				
					
				
					include "scripts/search_for.php"; // search function for browse
					
					

					$catID = -1; // defaults
					$orderID = -1;
					$search = "";
					if (isset($_GET['search'])){
						$search = $_GET['search']; // init var
					}
					if (isset($_GET['catID'])){
						$catID = $_GET['catID'];
					}
					if (isset($_GET['orderID'])){
						$orderID = $_GET['orderID'];
					}
					
					
					
					
					
					function relevanceConfig($query, $con, $search){
						if (!$con){
							die('Could not connect: ' . mysql_error());
						}
						if (mysql_query($query ,$con)){
							$output = (mysql_query($query ,$con));
							while($row = mysql_fetch_array($output)){
								// get search relevance for each individual item
								$searchArr = explode(" ", $search);
								$relevance = 0;
								$itemID = $row['itemID'];
								// title is weighted 5
								// tags are weighted 2
								// description is weighted 1
								foreach($searchArr as &$current){
									if (search_for($row['itemName'], $current)){
										$relevance += 5;
									}
									if (search_for($row['tags'], $current)){
										$relevance += 2;
									}
									if (search_for($row['itemDescription'], $current)){
										$relevance += 1;
									}
								}
								if ($search == ""){
									$relevance = 0; // if all items are being returned, then no ordering
								}
								
								$updateQuery = "UPDATE `items`
								SET `searchRelevance`='$relevance'
								WHERE `itemID`='$itemID'";
								executeQuery($updateQuery, $con);
								
							}						
						}
						else{
							echo mysql_error();
						}
						
					}
					
					
					
					
					
					
					//for now, no catagories are returned.
					
					function stripSyntax($str){
						$newStr = "";
						$len = strlen($str);
						for($i = 0; $i < $len; $i++){
							if ($str[$i] != "-" && $str[$i] != "+"){
								$newStr .= $str[$i];
							}
						}
						return $newStr;
					}
					
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
								
								
									$success = false;
									$notFlag = false;
									$andFlag = false;
									$searchArr = explode(" ", $search); // splits by space
									$count = 0;
									foreach($searchArr as $currentSearch){
										//echo json_encode($currentSearch);
										if (!empty($currentSearch)){
											if ($currentSearch[0] == "-"){
												$notFlag = true;
											}
											if ($currentSearch[0] == "+"){
												$andFlag = true;
											}
										}
										
										// search defaults as OR
										
										
										$currentSearch = stripSyntax($currentSearch);
										
										$currentSuccess = false;
										
										if(search_for($row['itemName'], $currentSearch) || search_for($row['tags'], $currentSearch) ||search_for($row['itemDescription'], $currentSearch)){
											$currentSuccess = true; // search success
										}
										//echo $row['itemName'];
										//echo $notFlag;
										//echo $currentSuccess;
										//echo $currentSearch;
										//echo "-------";
										
										if ($notFlag){
											$success = $success && !$currentSuccess;
											
										} else if ($andFlag) {
											$success = $success && $currentSuccess;
										} else {
											$success = $success || $currentSuccess;
										}
										$count++;
									}
									
									
								
									//echo "search is not empty";
									
									//$bool = search_for($row['itemName'], $search);
									//echo "$bool";
									
								
									if($success){
									
										$idParam = $row['itemID'];
									
										
										echo "<div class='browseDiv'  onClick='goToBuy($idParam)'>";
										include "scripts/browseButton.php"; // renders the button
										echo "</div>";
										
										
									}
								}
								else{
									//if the search is empty, dump it all
									
									
									$idParam = $row['itemID'];
									
									echo "<div class='browseDiv' onClick='goToBuy($idParam)'>";
									include "scripts/browseButton.php"; // renders the button
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
					
					//echo $search;
					
					$query = "SELECT * FROM `items`";
					relevanceConfig($query, $con, $search);
					
					
					
					// configure orderType
					if ($orderID == 3){
						$orderType = "-searchRelevance";
					} elseif ($orderID == 2){
						$orderType = "itemPrice";
					} else if ($orderID == 1){
						$orderType = "-itemPrice"; // gives opposite effect
					} else if ($orderID == 4){
						$orderType = "-averageRating"; // gives opposite effect
					}  else {
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
						renderListBoxCatMessage($query, $con, "All Categories");
						
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
							<option value="3">Relevance</option>
							<option value="4">Rating - Highest To Lowest</option>
						</select>
					</p>
				</div>
			</div>
		</div>
	</body>
</html>