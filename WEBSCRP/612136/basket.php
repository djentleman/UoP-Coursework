	<?php
		include "header.php";
		
		if (!isset($_SESSION['basket'])){
			$_SESSION['basket'] = new Basket();
			//echo $_SESSION['basket'];
		} else {
			//$_SESSION['basket'] = new Basket();
		}// init
		if (!isset($_SESSION['flag'])){
			$_SESSION['flag'] = false; // init, unlocked
		}
		
	?>
		<script src="js/form_buy.js"></script> <!-- fetching item pages -->
		<script src="ajax/clear_basket.js"></script> <!-- AJAX for clearing basket -->
		<script src="ajax/update_basket.js"></script> <!-- AJAX for updating basket -->
		<script src="ajax/check_valid_quantity.js"></script> <!--AJAX for DHTML -->
		<script src="js/getOrderDetails.js"></script> <!-- Ajax to pass to next page -->
		
		<script>
			function runBuy(){
				var valid = validate();
				if (valid){
					var isInvalid = buyClearRefresh();
				}
				console.log(isInvalid);
				//if (!isInvalid) { // isInvalid needs to be false
				//	console.log("hi");
				//	getOrderDetails();
				//}
			}
            
            function runUpdate(itemID, quanID){
                checkValid(itemID , quanID);
                return false
                
            }
			
			function validate(){
				var boxes = document.getElementsByClassName('invalidBox');
				if (boxes.length == 0){
					return true;
				}
				return false;
			}	
		</script>

		
		<div class="mainContent">
			<br>
			<br>
			
			
			
					<?php
					
									//echo json_encode($_SESSION);
						// adding new items>
						// validation uses a session flag
						if (isset($_POST['itemID'])){ // has a new thing just beed added?
							if(empty($_SESSION['basket'])){ // basket empty
								// no need to check flag
								$itemIdToAdd = $_POST['itemID'];
								$itemQuant = $_POST['quanToBuy'];
								if (is_numeric($itemQuant)){
									//echo json_encode($_SESSION);
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
							
						
						echo "<div id='basketTable' style='font-size:15px'>";
						include "scripts/get_basket.php"; // renders basket
						echo "</div>";
						
						
					?>
				
				<div style='float:right; margin-right:13%'>	
					<button onclick="return runBuy()">Buy</button> <!-- stock operations go here -->
					<button onclick="return clearAndRefresh()">Clear Basket</button> <!-- AJAX call -->
				</div>
				
				<p style="margin-top: 40px" id="dynamic"></p>
				
			<br>
			<br>
			<br>
		</div>
		
	<script src="ajax/buy_item.js"></script> <!-- stock control -->
	<!-- at bottom so everything is declared on page -->
	</body>
</html>