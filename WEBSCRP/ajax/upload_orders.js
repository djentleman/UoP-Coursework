// Upload New Comment w/ Ajax


function uploadOrdersAndRefresh(){
	uploadOrders(); // uploads new comment
	//refresh(); // refreshes current comments
	return false; // prevent refresh
}


function uploadOrders() {
	//uploads new comment

	

	// declare the two variables that will be used
	var xhr, changeListener;
	
	

	// create a request object


	
	
	// ----------- generic variables decalred ----------- //
	
	var basketSize = document.getElementById('basketSize').value;
	var buyerName = document.getElementById('buyerName').value;
	var buyerAddress = document.getElementById('buyerAddress').value;
	var buyerPostcode = document.getElementById('buyerPC').value;
	var buyerEmail = document.getElementById('buyerEmail').value;
	var buyerPhoneNo = document.getElementById('buyerPhoneNo').value;
	
	var count = 0;
	var lock = false;
	
	for (var i = 0; i < basketSize; i++){
		// ----------- non generic variables decalred ----------- //
		
		xhr = new XMLHttpRequest();
		count++;
		var currentIdString = "id" + (i + "");
		var currentQuanString = "quan" + (i + "");
		var itemId = document.getElementById(currentIdString).value;
		var orderQuantity = document.getElementById(currentQuanString).value;
		
		
		
		var stringToPass = "?itemID=" + itemId + "&orderQuantity=" + orderQuantity + "&buyerName=" + buyerName
						 + "&buyerAddress=" + buyerAddress + "&buyerPostcode=" + buyerPostcode + "&buyerEmail=" + buyerEmail
						 + "&buyerPhoneNo=" + buyerPhoneNo;
	
		xhr.onreadystatechange = changeListener;
		xhr.open("GET", "./scripts/uploadOrder.php" + stringToPass, true);
		xhr.send();
	}
	
	
	
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				console.log("cycling");
				
				
				// orders update here
			}
		}
	};
	
	target = document.getElementById("dynamicWrap");
	target.innerHTML = "<p>Transaction Complete</p><p>Thank You For Shopping With Tbuyer</p>";
	return false;

	
	
};


