// Clear Basket w/ Ajax


function buyClearRefresh(){
	// we can get the quantity from the item id
	var rows = document.getElementById("rows").innerHTML;
	return buyItems(rows);
}


function buyItems(basketSize) {
	//uploads new comment

	

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("dynamic"); // refresh dynamic text with callback

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
			
				target.innerHTML = xhr.responseText;
				
				var callback = xhr.responseText;
				var callbackArr = callback.split(" ");
				var lastWord = callbackArr[callbackArr.length - 1];
				if (!(lastWord == "Store<br>")){ // if transation works
					console.log("works");
					return clear();
				} // else, nothing to do here
				
				return true;

			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
			//target.innerHTML = "<p> Loading... </p>";
		}
	};
	
	
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
	
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/buy_item.php" + stringToPass, true); // clears
	xhr.send();
	
	
	
	return false; //stops page from refreshing
	
};


function clear() {
	//uploads new comment

	

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("basketTable"); // refresh dynamic text with callback

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				
				
				getOrderDetails();
				return refresh(); // Refreshes page

			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
			//target.innerHTML = "<p> Loading... </p>";
		}
	};
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/clear_basket.php", true); // clears
	xhr.send();
	
	
	
	return false; //stops page from refreshing
	
};

function refresh(){
	// re-renders (clears) basket
	// same code as clear basket, as variables and hardled through session
	
	
	var xhr, target, changeListener;
	
	
	target = document.getElementById("basketTable");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				


				target.innerHTML = xhr.responseText; // rendered text from php
				

			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
			target.innerHTML = "<p> Loading... </p>";
		}
	};
	

	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/get_basket.php", true);
	xhr.send();
	
	return false; //stops page from refreshing


};

