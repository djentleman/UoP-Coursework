// Udate  Catagory w/ Ajax


function editCat() {

	// declare the two variables that will be used
	var xhr, changeListener;

	// create a request object
	xhr = new XMLHttpRequest();
	
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				alert("The Catagory Has Been Updated");
			} else {
				alert("Something Went Wrong, Try Reloading The Page.");
			}
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	

	var catagoryName = document.getElementById('catName').value;

	var catagoryID = document.getElementById('catagoryList').value;
	

	
	
	var stringToPass = "?catagoryName=" + catagoryName + "&catagoryID=" + catagoryID;
	
	xhr.open("GET", "../scripts/update_catagory_complete.php" + stringToPass, true);
	xhr.onreadystatechange = changeListener;
	xhr.send();
	
	return false;

};