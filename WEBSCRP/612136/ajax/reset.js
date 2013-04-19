// Reset Database

function reset() {
	

	// declare the two variables that will be used
	var xhr, changeListener;


	// create a request object
	xhr = new XMLHttpRequest();

	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				// add the retrieved content to it using
				// the innerHTML property
				alert("The Database Has Been Wiped & Reset");
			} else {
				alert("Something Went Wrong, Try Reloading The Page.");
			}
		}
	};

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	xhr.open("GET", "../scripts/create_database.php");
	xhr.onreadystatechange = changeListener;
	xhr.send();
	
	return false; //stops refreshing

};
