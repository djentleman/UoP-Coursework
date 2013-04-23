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
			
			function checkValidEmail(){
				// buyerEmail validation
				
				// id will always be buyerEmail
				
				var target = document.getElementById('buyerEmail');
				var email = target.value;
				
				var regex = new RegExp("^(.|_|[A-Z]|[a-z]|[0-9])+@(_|[A-Z]|[a-z]|[0-9])+[.]([a-z]{2,4}[.][a-z]{2,4}|[a-z]{2,4})$");
				var valid = regex.test(email);
				
				if (valid){
					target.className = "validBox";
				} else {
					target.className = "invalidBox";
				}
				//console.log(valid);
				return false;
			}
			
			function checkValidPhone(){
				// buyerPhoneNo validation
				
				// id will always be buyerPhoneNo
				
				var target = document.getElementById('buyerPhoneNo');
				var phoneNo = target.value;
				
				var regex = new RegExp("^[0-9]{5}[ ]?[0-9]{6}$");
				var valid = regex.test(phoneNo);
				
				if (valid){
					target.className = "validBox";
				} else {
					target.className = "invalidBox";
				}
				//console.log(valid);
				return false;
			}
			
			function checkValidPostcode(){
				// buyerPostcode validation
				
				// id will always be buyerPostcode
				
				var target = document.getElementById('buyerPC');
				var postcode = target.value;
				
				var regex = new RegExp("^([A-Z]|[0-9]){3,4}[ ]([A-Z]|[0-9]){3,4}$");
				var valid = regex.test(postcode);
				
				if (valid){
					target.className = "validBox";
				} else {
					target.className = "invalidBox";
				}
				console.log(valid);
				return false;
			}
			
			function validate(){
				// check class of every text box, if valid then call function, else validate
				var isValid = true;
				if (document.getElementById('buyerName').className == "invalidBox"){
					// invalid
					isValid = false;
				}
				
				if (document.getElementById('buyerAddress').className == "invalidBox"){
					// invalid
					isValid = false;
				}
				
				if (document.getElementById('buyerPC').className == "invalidBox"){
					// invalid
					isValid = false;
				}
				
				if (document.getElementById('buyerEmail').className == "invalidBox"){
					// invalid
					isValid = false;
				}
				
				
				if (document.getElementById('buyerPhoneNo').className == "invalidBox"){
					// invalid
					isValid = false;
				}
				
				if (isValid){
					document.getElementById('invalidResponse').innerHTML = "";
					return uploadOrdersAndRefresh();
				}
				
				document.getElementById('invalidResponse').innerHTML = "Invalid Input";
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
					<input onkeyup="return checkValidPostcode();" class="invalidBox" id="buyerPC" type="text">
					
					<p>Enter Email*:</p>
					<input onkeyup="return checkValidEmail();" class="invalidBox" id="buyerEmail" type="text">
					<p></p>
					
					<p>Enter Phone Number*:</p>
					<input onkeyup="return checkValidPhone();" class="invalidBox" id="buyerPhoneNo" type="text">
					<p></p>
					
					<button onclick="return validate();">Submit Order</button> <!-- que JS function to handle -->
					
					<p id="invalidResponse"></p>
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