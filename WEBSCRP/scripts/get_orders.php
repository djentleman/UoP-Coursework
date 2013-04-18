					<?php	
						// uses the same css formatting as basket
						
						include "executeQuery.php";
						include "getData.php";

						
					function executeResults($query, $con){
						if (!$con){
							die('Could not connect: ' . mysql_error());
						}
						if (mysql_query($query ,$con)){
							$output = (mysql_query($query ,$con));
							$count = 0;
							while($row = mysql_fetch_array($output)){
									$itemID = $row['itemID'];
									$buyerName = $row['buyerName'];
									$buyerEmail = $row['buyerEmail'];
									$buyerPostcode = $row['buyerPostcode'];
									$buyerPhoneNo = $row['buyerPhoneNo'];
									$quantity = $row['orderQuantity'];
									
									$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
									$dataArr = getData($query, $con);
									$itemName = $dataArr[0];
									
									
									$quanId = $itemID . ""; // stringify
									
									echo "<div class='basketRow'>";
									
									echo "<div class='buyerInfoWrap'>";
									echo $buyerName;
									echo "</div>";
									
									echo "<div onclick='goToBuy($itemID, true)' class='itemNameWrap'>";
									echo $itemName;
									echo "</div>";
									
									echo "<div class='orderQuantityWrap'>"; // middle
									echo $quantity;
									echo "</div>";
									
									echo "<div class='postCodeWrap'>";
									echo $buyerPostcode;
									echo "</div>";
									
									echo "<div class='buyerEmailWrap'>";
									echo $buyerEmail;
									echo "</div>";
									
									echo "<div class='buyerInfoWrap'>";
									echo $buyerPhoneNo;
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

							echo "<div class='orderTable'>";
							
							echo "<div class='basketRow'>";
							
							echo "<div class='buyerInfoWrap'>";
							echo "Buyer Name";
							echo "</div>";
							
							echo "<div style='width:20%;height:18px;float:left;'>";
							echo "Item Ordered";
							echo "</div>";
							
							echo "<div class='orderQuantityWrap'>";
							echo "Quantity";
							echo "</div>";
							
							echo "<div class='postCodeWrap'>";
							echo "Postcode";
							echo "</div>";
							
							echo "<div class='buyerEmailWrap'>";
							echo "Email";
							echo "</div>";
							
							echo "<div class='buyerInfoWrap'>";
							echo "Phone No";
							echo "</div>";
							
							echo "</div>";

							
							
							
						$query = "SELECT * FROM `orders`";
						executeResults($query, $con);
						
							echo "</div>";
							echo "</div>";
						
						
						mysql_close($con);

						// have to use innerHTML as value wasn't working
					?>