// Upload New Catagory w/ Ajax


function uploadCat() {

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	target = document.getElementById("dynamicText");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
			
				target.innerHTML = "The New Catagory: " + catagoryName + " Has Been Uploaded";
				target.style.backgroundColor = "#4DB870";
				// add the retrieved content to it using
				// the innerHTML property
				
				//alert("The New Catagory Has Been Uploaded");
			} else {
				//alert("Something Went Wrong, Try Reloading The Page.");
			}
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	
	
	var catagoryName = document.getElementById('catName').value;
	var stringToPass = "?catagoryName=" + catagoryName;
	
	xhr.open("GET", "../scripts/catagory_upload_complete.php" + stringToPass, true);
	xhr.onreadystatechange = changeListener;
	xhr.send();

	return false;
};