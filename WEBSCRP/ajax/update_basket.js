// Update Basket w/ Ajax


function updateAndRefresh(itemID){
	// we can get the quantity from the item id
	update(itemID); // uploads new comment
	//refresh(); // refreshes current comments
	return false; // prevent refresh
}


function update(itemID) {
	//uploads new comment

	

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("basketTable");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				

				refresh(); // Refreshes page

			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
			//target.innerHTML = "<p> Loading... </p>";
		}
	};

	// itemID is passed through
	var quanID = "" + itemID; // stringified
	var quantity = document.getElementById(quanID).value;
	
	var stringToPass = "?itemID=" + itemID + "&quantity=" + quantity;
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/update_basket.php" + stringToPass, true); // clears
	xhr.send();
	
	
	
	return false; //stops page from refreshing
	
};

function refresh(){
	// re-renders basket
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

