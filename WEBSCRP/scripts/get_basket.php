					<?php	
						
						
						include "executeQuery.php";
						include "getData.php";
						
						if (!isset($_SESSION['basket'])){
							include "classes/basket.php"; // catch for ajax loads
							session_start();
						}
						
						
						$basket = $_SESSION['basket'];
						
						$basketSize = $basket->getSize();
						echo "<p id='basketSize' value='$basketSize'></p>";
						
						$con = mysql_connect("localhost","root"); // will be querying item IDs
						$query = "USE `tbuyer`";
						executeQuery($query, $con); // use tbuyer
						
						
						// displays basket
						$count = 0;
						$totalPrice = 0;
						echo "Basket:";
						if (empty($basket->itemIDs)){
							echo "Basket Is Empty";
						} else {
							echo "<div class='basketTable'>";
							
							echo "<div class='basketRow'>";
							
							echo "<div style='width: 20%;float:left'>";
							echo "Item Name";
							echo "</div>";
							
							echo "<div class='basketQuanWrap'>";
							echo "Quantity";
							echo "</div>";
							
							echo "<div class='basketPriceWrap'>";
							echo "Price";
							echo "</div>";
							
							echo "</div>";
							
							foreach ($basket->itemIDs as &$currentID){
								echo "<div class='basketRow'>";
								// on click goes to buy page
								
								$itemID = $currentID;
								
								$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
								$dataArray = getData($query, $con);
								
								$itemName = $dataArray[0]; // name
							
								echo "<div class='basketIdWrap' onClick='goToBuy($currentID)'>";
								echo $itemName;
								echo "</div>";
								
								$quan = $basket->quantities[$count];
								$quanID = "" . $currentID; // stringified
								
								echo "<div class='basketQuanWrap'>"; // middle
								echo "<input id='$quanID' style='width:22px; height:12px' type='text' value='$quan'>";
								echo "</div>";
								
								
								
								$itemPrice = $dataArray[2]; // price
								$itemPrice = $itemPrice * $basket->quantities[$count]; // multiply by quantity
								$totalPrice += $itemPrice;
								
								echo "<div class='basketPriceWrap'>";
								echo "£" . $itemPrice;
								echo "</div>";
								
								
								echo "<p class='updateButton' onclick='return updateAndRefresh($itemID)'>update</p>";
								
								echo "</div>";
								$count++;
							}
							echo "</div>";
						}
						
						mysql_close($con);
						
						
						
						
						echo "<p style='float:left; margin-left: 20%;'>Total Price: £" . $totalPrice . "</p>";
					?>