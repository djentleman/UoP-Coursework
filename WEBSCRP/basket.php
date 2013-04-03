	<?php
		include "header.php";
		include "scripts/executeQuery.php";
		include "scripts/getData.php";
		
		if (!isset($_SESSION['basket'])){
			$_SESSION['basket'] = new Basket();
		} // init
		if (!isset($_SESSION['flag'])){
			$_SESSION['flag'] = false; // init, unlocked
		}
		
	?>
		<script src="js/form_buy.js"></script>
		
		<div class="mainContent">
			<br>
			<br>
			
			
					<?php
						
					    // validation uses a session flag
						if (isset($_POST['itemID'])){ // has a new thing just beed added?
							if(empty($_SESSION['basket'])){ // basket empty
								// no need to check flag
								$itemIdToAdd = $_POST['itemID'];
								$itemQuant = $_POST['quanToBuy'];
								if (is_numeric($itemQuant)){
									$_SESSION['basket']->addItem($itemIdToAdd, intval($itemQuant));
									$_SESSION['flag'] = true; // true = locked
								}
							} else { 
								if ($_SESSION['flag'] == false){
									$itemIdToAdd = $_POST['itemID'];
									$itemQuant = $_POST['quanToBuy'];
									if (is_numeric($itemQuant)){
										$_SESSION['basket']->addItem($itemIdToAdd, intval($itemQuant));
										$_SESSION['flag'] = true; // true = locked
									}
								} // else flag is locked
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
								echo "<input id='$quanID' style='width:22px; height:10px' type='text' value='$quan'>";
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
				
				<div style="margin-top:19px">	
					<button>Buy</button> <!-- stock operations go here -->
					<button>Update</button> <!-- updates quantities, removes anything with quantitiy 0 -->
					<button>Clear Basket</button> <!-- AJAX call -->
				</div>
				
			<br>
			<br>
			<br>
		</div>
	</body>
</html>