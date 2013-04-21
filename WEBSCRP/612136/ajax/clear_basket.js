// Clear Basket w/ Ajax


function clearAndRefresh(){
	clearBasket(); // uploads new comment
	//refresh(); // refreshes current comments
	return false; // prevent refresh
}


function clearBasket() {
	//uploads new comment

	

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("basketTable");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				

				refreshFromClear(); // Refreshes page

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

function refreshFromClear(){
	//re-renders comments
	
	
	// declare the two variables that will be used
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

