					<?php	
						
						
						include "executeQuery.php";
						include "getData.php";
						
						if (!isset($_SESSION['basket'])){
							include "classes/basket.php"; // catch for ajax loads
							session_start();
						}
						
						
						$basket = $_SESSION['basket'];
						
						
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
							$basketCounter = 0;
							foreach ($basket->itemIDs as &$currentID){
								$rowId = "row" . $basketCounter;
								$itemNo = "no" . $basketCounter;
								echo "<div id='$rowId' class='basketRow'>";
								// on click goes to buy page
								
								$itemID = $currentID;
								
								$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
								$dataArray = getData($query, $con);
								
								$itemName = $dataArray[0]; // name
							
								echo "<div value='$currentID' class='basketIdWrap' onClick='goToBuy($currentID)'>";
								echo "<input type='hidden' id='$itemNo' value='$currentID'>";
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
								$basketCounter++;
							}
							echo "</div>";
						}
						
						mysql_close($con);
						
						
						
						
						
						
						echo "<p style='float:left; margin-left:13%; margin-top:19px;'>Total Price: £" . $totalPrice . "</p>";
						$rows = $basket->getSize();
						echo "<div id='rows' value='$rows' style='visibility:hidden'>$rows</div>";
						// have to use innerHTML as value wasn't working
					?>