// Upload New Item w/ Ajax


function uploadItem() {

	// declare the two variables that will be used
	var xhr, changeListener;

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				// add the retrieved content to it using
				// the innerHTML property
			} else {
			}
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	
	
	var itemName = document.getElementById('itemName').value;
	var quantity = document.getElementById('quan').value;
	var price = document.getElementById('price').value;
	var sellerName = document.getElementById('sellerName').value;
	var isNew = document.getElementById('isNew').checked + ""; //stringify
	var tags = document.getElementById('tags').value;
	var catagoryID = document.getElementById('catagoryList').value;
	var description = document.getElementById('desc').value;
	
	
	
	
	var stringToPass = "?itemName=" + itemName + "&itemQuantity=" + quantity + "&price=" + price;
	stringToPass += "&sellerName=" + sellerName + "&new=" + isNew + "&tags=" + tags + "&catagoryID=" + catagoryID;
	stringToPass += "&description=" + description;
	
	
	xhr.open("GET", "../scripts/item_upload_complete.php" + stringToPass, true);
	
	
	
	xhr.onreadystatechange = changeListener;
	xhr.send();

};