	<?php
		include "header.php";
		
		if (!isset($_SESSION['basket'])){
			$_SESSION['basket'] = new Basket();
		} // init
		if (!isset($_SESSION['flag'])){
			$_SESSION['flag'] = false; // init, unlocked
		}
		
	?>
		<script src="js/form_buy.js"></script> <!-- fetching item pages -->
		<script src="ajax/clear_basket.js"></script> <!-- AJAX for clearing basket -->
		<script src="ajax/update_basket.js"></script> <!-- AJAX for updating basket -->
		
		<div class="mainContent">
			<br>
			<br>
			
			
					<?php
						// adding new items>
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
							
						
						echo "<div id='basketTable'>";
						include "scripts/get_basket.php"; // renders basket
						echo "</div>";
						
					?>
				
				<div style="margin-top:19px">	
					<button>Buy</button> <!-- stock operations go here -->
					<button onclick="return clearAndRefresh()">Clear Basket</button> <!-- AJAX call -->
				</div>
				
			<br>
			<br>
			<br>
		</div>
	</body>
</html>