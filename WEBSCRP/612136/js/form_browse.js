
function browse(){
// uses JS to load browse page (execute HTTP GET)
// this stops the submit button being a GET parameter (do not want)
	
	var search = document.getElementById('searchValue').value
	var stringToPass = "?search=" + search; // contruct GET string
	location = "browse.php" + stringToPass; // changes page
};

function browseWithCat(){
	// uses JS to load page with GET
	// incorporates category ID
	
	var search = document.getElementById('catSearch').value;
	var catID = document.getElementById('catagoryList').value;
	var orderID = document.getElementById('orderType').value;
	console.log("hello");
	
	var stringToPass = "?search=" + search + "&catID=" + catID + "&orderID=" + orderID;
	location = "browse.php" + stringToPass;
}

