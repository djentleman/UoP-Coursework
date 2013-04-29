// Udate Item w/ Ajax


function editItem() {

	// declare the two variables that will be used
	var xhr, changeListener;

	// create a request object
	xhr = new XMLHttpRequest();
	
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				document.getElementById('dynamicText').innerHTML = "Item Successfully Updated";
			} else {
				document.getElementById('dynamicText').innerHTML = "Something Went Wrong. Try Refreshing The Page";
			}
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	
	
	// lots of variables for item update!
	
	var itemID = document.getElementById('itemList').value; // from listBoxRender
	var itemName = document.getElementById('itemName').value;
	var quantity = document.getElementById('quantity').value;
	var price = document.getElementById('price').value;
	var sellerName = document.getElementById('sellerName').value;
	var isNew = document.getElementById('isNew').value;
	var tags = document.getElementById('tags').value;
	var catagoryID = document.getElementById('catagoryList').value; // from listBoxRender
	var desc = document.getElementById('desc').value;
	
	
	//GET String
	var stringToPass = "?itemID=" + itemID + "&itemName=" + itemName + 
						"&itemQuantity=" + quantity + "&itemPrice=" + price +
						"&sellerName=" + sellerName + "&isNew=" + isNew +
						"&tags=" + tags + "&catagoryID=" + catagoryID +
						"&description=" + desc;
	
	xhr.open("GET", "../scripts/update_item_complete.php" + stringToPass, true);
	xhr.onreadystatechange = changeListener;
	xhr.send();
	
	return false;

};