	<?php
		include "header.php";
		include "scripts/executeQuery.php";
		include "scripts/getData.php";
	?>
		<script src="js/form_buy.js"></script>
		
		<div class="mainContent">
			<br>
			<br>
			
			
					<?php
					
						
					    // fix validation by using a session flag?
						if (isset($_POST['itemID'])){ // has a new thing just beed added?
							if(empty($_SESSION['basket'])){
								// no need to check quantity
								$itemIdToAdd = $_POST['itemID'];
								// lets make the quantity 3
								$_SESSION['basket']->addItem($itemIdToAdd, 3);
							} else{ 
								if ($_POST['itemID'] != ($_SESSION['basket']->itemIDs[$_SESSION['basket']->getSize() - 1])){ // check quantity too
									$itemIdToAdd = $_POST['itemID'];
									// lets make the quantity 3
									$_SESSION['basket']->addItem($itemIdToAdd, 3);
								}
							}
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
							
							echo "<div class='basketIdWrap'>";
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
								echo "<div class='basketRow' onClick='goToBuy($currentID)'>";
								// on click goes to buy page
								
								$itemID = $currentID;
								
								$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
								$dataArray = getData($query, $con);
								
								$itemName = $dataArray[0]; // name
							
								echo "<div class='basketIdWrap'>";
								echo $itemName;
								echo "</div>";
								
								echo "<div class='basketQuanWrap'>"; // middle
								echo $basket->quantities[$count];
								echo "</div>";
								
								$itemPrice = $dataArray[2]; // price
								$itemPrice = $itemPrice * $basket->quantities[$count]; // multiply by quantity
								$totalPrice += $itemPrice;
								
								echo "<div class='basketPriceWrap'>";
								echo "£" . $itemPrice;
								echo "</div>";
								
								echo "</div>";
								$count++;
							}
							echo "</div>";
						}
						
						mysql_close($con);
						
						
						
						
						echo "<p style='float:left; margin-left: 20%;'>Total Price: £" . $totalPrice . "</p>";
						
					?>
					
				<button>Buy</button> <!-- stock operations go here -->
			<br>
			<br>
			<br>
		</div>
	</body>
</html>