// Get Order Details


function getOrderDetails(){
	// we can get the quantity from the item id
	console.log("hi2");
	var rows = document.getElementById("rows").innerHTML;
	if (rows != 0){
		goToOrderInput(rows);
	} else {
		console.log("no rows");
	}
}


function goToOrderInput(basketSize) {
	//uploads new comment

	

	
	
	//var basketSize = document.getElementById("basketSize").value; // number of items
	var stringToPass = "?basketSize=" + basketSize; // params

	
	// now we know how many rows there are
	for (var i = 0; i < parseInt(basketSize); i++){
		var itemNumber = "no" + i; // stringify; i = 1 => no1
		var currentID = document.getElementById(itemNumber).value;
		var quanId = currentID + ""; // stringify
		var quantity = document.getElementById(quanId).value;
		
		var idTag = "id" + i;
		var quanTag = "quan" + i;
		
		var params = "&" + idTag + "=" + currentID + "&" + quanTag + "=" + quantity;
		stringToPass = stringToPass + params;
	}
	
	console.log("getOrderDetails.php" + stringToPass);
	
	location = "getOrderDetails.php" + stringToPass; // changes page

	
	
};



