	<?php 
		include "header.php" 
	?>
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
			
			<form class="orderDetailsForm left">
			
				<h3>Enter Order Details</h3>
				
				<p>Enter Name*:</p>
				<input onkeyup="return checkValid(false, 'buyerName');" class="invalidBox" id="buyerName" type="text">
				
				<p>Enter Address*:</p>
				<textarea onkeyup="return checkValid(false, 'buyerAddr');" class="invalidBox" id="buyerAddr" cols="25" rows="5"></textarea>
				
				<p>Enter Post Code*:</p>
				<input onkeyup="return checkValid(false, 'buyerPC');" class="invalidBox" id="buyerPC" type="text">
				
				<p>Enter Email*:</p>
				<input onkeyup="return checkValid(false, 'buyerEmail');" class="invalidBox" id="buyerEmail" type="text">
				<p></p>
				
				<p>Enter Phone Number*:</p>
				<input onkeyup="return checkValid(true, 'buyerPhoneNo');" class="invalidBox" id="buyerPhoneNo" type="text">
				<p></p>
				
				<button>Submit Order</button>
			</form>
			
		</div>
	</body>
</html>