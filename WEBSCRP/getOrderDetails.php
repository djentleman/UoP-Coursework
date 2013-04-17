	<?php 
		include "header.php" 
		
	?>
		<script src="ajax/upload_orders.js"></script>
		<script>
			function checkValid(isNumeric, id){
				// if isNumeric, then contents must be numeric, else just validate for ""
				// id is for getElement
				
				var input = document.getElementById(id).value;
				
				if (isNumeric){
					if (isNaN(input) || (input == "")){
						document.getElementById(id).className = "invalidBox";
					} else {
						if (input < 0){
							document.getElementById(id).className = "invalidBox";
						} else {
							document.getElementById(id).className = "validBox";
						}
					}
				} else {
					if (input == ""){
						document.getElementById(id).className = "invalidBox";
					} else {
						document.getElementById(id).className = "validBox";
					}
				}
				return false;
			}
		</script>
		
		
		<div class="mainContent">
			<h1>Complete Order</h1>
			<p>* indicates requred field</p>
			
			<div id="dynamicWrap">
				<form class="orderDetailsForm left">
				
					<h3>Enter Order Details</h3>
					
					<p>Enter Name*:</p>
					<input onkeyup="return checkValid(false, 'buyerName');" class="invalidBox" id="buyerName" type="text">
					
					<p>Enter Address*:</p>
					<textarea onkeyup="return checkValid(false, 'buyerAddress');" class="invalidBox" id="buyerAddress" cols="25" rows="5"></textarea>
					
					<p>Enter Post Code*:</p>
					<input onkeyup="return checkValid(false, 'buyerPC');" class="invalidBox" id="buyerPC" type="text">
					
					<p>Enter Email*:</p>
					<input onkeyup="return checkValid(false, 'buyerEmail');" class="invalidBox" id="buyerEmail" type="text">
					<p></p>
					
					<p>Enter Phone Number*:</p>
					<input onkeyup="return checkValid(true, 'buyerPhoneNo');" class="invalidBox" id="buyerPhoneNo" type="text">
					<p></p>
					
					<button onclick="return uploadOrdersAndRefresh()">Submit Order</button> <!-- que JS function to handle -->
				</form>
				<div class="orderInfo">
					<?php
						if (isset($_GET['basketSize'])){
							$basketSize = $_GET['basketSize'];
							
							echo "<input type='hidden' id='basketSize' value='$basketSize'>";
					
							for ($i = 0; $i < $basketSize; $i++){
								$currentIdString = "id" . ($i . "");
								$currentQuanString = "quan" . ($i . "");
								
								$currentId = $_GET[$currentIdString];
								$currentQuan = $_GET[$currentQuanString];
								
								echo "<input type='hidden' id='$currentIdString' value='$currentId'>";
								echo "<input type='hidden' id='$currentQuanString' value='$currentQuan'>";

							}
						}
					
					?>
				</div>
			</div>
		</div>
	</body>
</html>