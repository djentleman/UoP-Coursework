<?php

	// get items low on stock
	
					include_once "mysql.php";
	
	
						
					function getLowStockTable($query, $con){
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
									
										
										if ($quantity < 6){
											$count++;
											echo "<div class='basketRow'>";
											
											
											echo "<div style='color:red' class='stockIdWrap' onClick='goToBuy($itemID, true)'>";
											
											echo $itemName;
											echo "</div>";
											
											echo "<div style='color:red;' class='basketQuanWrap'>"; // middle
											
											echo $quantity;
											echo "</div>";
											
											echo "<div class='addStock' onclick='return addLowStock($itemID)'>"; // the button
											echo " + ";
											echo "</div>";
											
											echo "<div class='basketPriceWrap'>";
											echo "<input id=$quanId style='width:22px; height:12px' type='text'>";
											echo "</div>";
											

									
									
									echo "</div>";
								}
								
							}
							if ($count == 0){
								echo "<div class='basketRow'>";
								echo "There Doesn't Appear To Be Anything Low On Stock Right Now";
								echo "</div";
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
				echo "<div class='basketQuanWrap'>";
				echo "Stock";
				echo "</div>";							
				echo "<div class='basketPriceWrap'>";
				echo "Add Stock";
				echo "</div>";							
				echo "</div>";

							
							
		
				$query = "SELECT * FROM `items` ORDER BY `itemName`";
				getLowStockTable($query, $con);
						
				echo "</div>";
				echo "</div>";
					

?>