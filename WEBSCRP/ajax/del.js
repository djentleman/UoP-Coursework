// Delete General w/ Ajax


function del(isCatagory, id) { // boolean isCatagory, int id

	// declare the two variables that will be used
	var xhr, target, changeListener;
	if (isCatagory) {
		target = document.getElementById('catForm');
	} else {
		target = document.getElementById('itemForm');
	}

	// create a request object
	xhr = new XMLHttpRequest();
	
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				refreshItem(isCatagory);
			} else {
				target.innerHTML = "<p>Something Went Wrong :( </p>";
			}
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	

	if (isCatagory){ // init vars & xhr for catagory delete
		var delType = "cat";
		var stringToPass = "?catagoryID=" + id + "&delType=" + delType;
	
	
		xhr.open("GET", "../scripts/delete_complete.php" + stringToPass, true);
	} else { // init vars & xhr for item delete
		var stringToPass = "?itemID=" + id + "&delType=" + delType;
		
		
		xhr.open("GET", "../scripts/delete_complete.php" + stringToPass, true);
	}
	
	xhr.onreadystatechange = changeListener;
	xhr.send();
	
	return false;

};

function refreshItem(isCatagory){
	var xhr, target, changeListener;
	if (isCatagory) {
		target = document.getElementById('catForm');
	} else {
		target = document.getElementById('itemForm');
	}

	// create a request object
	xhr = new XMLHttpRequest();
	
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				target.innerHTML = xhr.responseText;
			}
		} else if (xhr.readyState > 0 && xhr.readyState > 4){
			target.innerHTML = loading;
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	

	if (isCatagory){
		xhr.open("GET", "../scripts/delete_content_catagory.php", true);
	} else {
		xhr.open("GET", "../scripts/delete_content_item.php", true);
	}
	
	xhr.onreadystatechange = changeListener;
	xhr.send();
	
	return false;

};