					<?php	
						// uses the same css formatting as basket
						
						include "executeQuery.php";
						include "getData.php";
						
						if (!isset($_SESSION['basket'])){
							include "classes/basket.php"; // catch for ajax loads
							session_start();
						}
						
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
									$quantity = $row['itemQuantity'];
									
									$quanId = $itemID . ""; // stringify
									
									echo "<div class='basketRow'>";
									
									if ($quantity < 6){
										echo "<div style='color:red' class='basketIdWrap' onClick='goToBuy($itemID)'>";
									} else {
										echo "<div class='basketIdWrap' onClick='goToBuy($itemID)'>";
									}
									echo $itemName;
									echo "</div>";
									
									if ($quantity < 6){
										echo "<div style='color:red;' class='basketQuanWrap'>"; // middle
									} else {
										echo "<div class='basketQuanWrap'>"; // middle
									}
									echo $quantity;
									echo "</div>";
									
									echo "<div class='addStock' onclick='return addStock($itemID)'>"; // the button
									echo " + ";
									echo "</div>";
									
									echo "<div class='basketPriceWrap'>";
									echo "<input id=$quanId style='width:22px; height:12px' type='text'>";
									echo "</div>";
									

									
									
									echo "</div>";
								
							}						
						}
						else{
							echo mysql_error();
						}
					}
						
					
						
						
						$basket = $_SESSION['basket'];
						
						
						$con = mysql_connect("localhost","root"); // will be querying item IDs
						$query = "USE `tbuyer`";
						executeQuery($query, $con); // use tbuyer
						
							echo "<div id='stockTable'>";

							echo "<div class='basketTable'>";
							
							echo "<div class='basketRow'>";
							
							echo "<div class='basketIdWrap'>";
							echo "Item Name";
							echo "</div>";
							
							echo "<div class='basketQuanWrap'>";
							echo "Stock";
							echo "</div>";
							
							echo "<div class='basketPriceWrap'>";
							echo "Add Stock";
							echo "</div>";
							
							echo "</div>";

							
							
							
						$query = "SELECT * FROM `items`";
						executeResults($query, $con);
						
							echo "</div>";
							echo "</div>";
						
						
						mysql_close($con);

						// have to use innerHTML as value wasn't working
					?>