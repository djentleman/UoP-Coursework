// Delete General w/ Ajax


function del(isCatagory) { // boolean, isCatagory

	// declare the two variables that will be used
	var xhr, changeListener;

	// create a request object
	xhr = new XMLHttpRequest();
	
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				alert("Deletion Successful");
			} else {
				alert("Something Went Wrong, Try Reloading The Page.");
			}
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	

	if (isCatagory){ // init vars & xhr for catagory delete
		var catID = document.getElementById('catagoryList').value;
		var delType = "cat";
		var stringToPass = "?catagoryID=" + catID + "&delType=" + delType;
	
	
		xhr.open("GET", "./scripts/delete_complete.php" + stringToPass, true);
	} else { // init vars & xhr for item delete
		var itemID = document.getElementById('itemList').value;
		var stringToPass = "?itemID=" + itemID + "&delType=" + delType;
		
		
		xhr.open("GET", "./scripts/delete_complete.php" + stringToPass, true);
	}
	
	xhr.onreadystatechange = changeListener;
	xhr.send();
	
	return false;

};