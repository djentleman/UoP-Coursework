
function browse(){
// uses JS to load browse page (execute HTTP GET)
// this stops the submit button being a GET parameter (do not want)
	
	var search = document.getElementById('searchValue').value;
	var stringToPass = "?search=" + search; // contruct GET string
	location = "browse.php" + stringToPass; // changes page
	
	
	console.log(stringToPass);
};

function browseWithCat(){
	// uses JS to load page with GET
	// incorporates category ID
	
	var search = document.getElementById('catSearch').value;
	//console.log(search);
	search = search.split('+').join('%2B'); // converts all '+' to %2B, code for plus
	//search = search.split(' ').join('+'); 
	console.log(search);
	//alert(search);
	var catID = document.getElementById('catagoryList').value;
	var orderID = document.getElementById('orderType').value;
	console.log("hello");
	
	
	
	var stringToPass = "?catID=" + catID + "&orderID=" + orderID + "&search=" + search;
	
	console.log(stringToPass);
	location = "browse.php" + stringToPass;
}

