// Update Basket w/ Ajax


function updateBasket(itemID){
	// we can get the quantity from the item id
    console.log("hi");
	if (document.getElementById(itemID + "").className == "validBox"){ // validate
        console.log("hi");
		update(itemID); // 
	}
	return false; // prevent refresh
}


function update(itemID) {
	//uploads new comment

	console.log("test");

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("basketTable");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				console.log(xhr.status);
				
				var load = "load" + quanID;
				

				refreshUpdate(load); // Refreshes page

			} else {
				//target.innerHTML = "<p>Something Went Wrong</p>";
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

function refreshUpdate(load){
	// re-renders basket
	// same code as clear basket, as variables and hardled through session
	console.log("refreshing");
	
	var xhr, target, changeListener;
	
	
	target = document.getElementById("basketTable");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
            console.log(xhr.staus);
			if (xhr.status === 200) {
				console.log("hello");


				document.getElementById(load).innerHTML = "";
				target.innerHTML = xhr.responseText; // rendered text from php

			} else {
				document.getElementById('loading').innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
				console.log("loading");
				document.getElementById(load).innerHTML = "Loading...";
		}
	};
	

	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/get_basket.php", true);
	xhr.send();
	
	return false; //stops page from refreshing


};

