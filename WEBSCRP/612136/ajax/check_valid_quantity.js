// ajax quantity validation

// Update Basket w/ Ajax


function checkValid(itemID, id){
	// we can get the quantity from the item id
	updateCheck(itemID, id); // uploads new comment
	//refresh(); // refreshes current comments
	return false; // prevent refresh
}


function updateCheck(itemID, id) {
	//uploads new comment

	

	// declare the two variables that will be used
	var xhr, changeListener;
	
	
	target = document.getElementById("basketTable");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
			
				var callback = xhr.responseText;
				if (callback == "0"){
					changeCSS(true, id);
				} else {
					changeCSS(false, id);
				}

			}
		}
	};

	// itemID is passed through
	
	console.log(id);
	
	var quantityToCheck = document.getElementById(id).value;
	
	var stringToPass = "?itemID=" + itemID + "&quantityToCheck=" + quantityToCheck;
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/compareQuants.php" + stringToPass, true); // clears
	xhr.send();
	
	
	
	return false; //stops page from refreshing
	
};

function changeCSS(isValid, id){
	// change class of combo box according to php callback
	if (isValid){
		document.getElementById(id).className = "validBox";
	} else {
		document.getElementById(id).className = "invalidBox";
	}
	
	



};

