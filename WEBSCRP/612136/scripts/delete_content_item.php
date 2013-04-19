<div id="itemForm">
<div class="leftDiv">
				<p class="left">Select Item To Delete</p>
				<!--  action="delete_complete.php"  OLD -->
				<form class="left"method="post">
					<?php
										
						// uses the same css formatting as basket
						
						include "mysql.php";

						
					function executeResults($query, $con){
						if (!$con){
							die('Could not connect: ' . mysql_error());
						}
						if (mysql_query($query ,$con)){
							$output = (mysql_query($query ,$con));
							$count = 0;
							while($row = mysql_fetch_array($output)){
									$itemID = $row['itemID'];
									$itemName = $row['itemName'];
									
									
									echo "<div class='basketRow'>";
									

									echo "<div class='stockIdWrap' onClick='goToBuy($itemID, true)'>";
									echo $itemName;
									echo "</div>";
									
									echo "<div class='addStock' onclick='return del(false, $itemID)'>"; // remove item & refresh
									echo " x ";
									echo "</div>";
									
									

									
									
									echo "</div>";
								
							}						
						}
						else{
							echo mysql_error();
						}
					}
						
						
						
						$con = mysql_connect("localhost","root"); // will be querying item IDs
						$query = "USE `tbuyer`";
						executeQuery($query, $con); // use tbuyer
						
							echo "<div id='stockTable'>";

							echo "<div class='basketTable'>";
							
							echo "<div class='basketRow'>";
							
							echo "<div style='width:30%; float:left; height:19px;'>";
							echo "Item Name";
							echo "</div>";
							
							echo "<div class='basketPriceWrap'>";
							echo "Remove";
							echo "</div>";
							
							echo "</div>";

							
							
							
						$query = "SELECT * FROM `items` ORDER BY `itemName`";
						executeResults($query, $con);
						
							echo "</div>";
							echo "</div>";
						
						
						mysql_close($con);

						// have to use innerHTML as value wasn't working
					
					?>
					
				</form>
			</div>
		</div>