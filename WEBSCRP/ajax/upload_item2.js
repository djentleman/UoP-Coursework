// Upload New Item w/ Ajax


function uploadItem2() {

	// declare the 3 variables that will be used
	var xhr, target, changeListener;
	
	target = document.getElementById("dynamicText");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				// add the retrieved content to it using
				// the innerHTML property
				target.innerHTML = "<p>Something Went Right</p>";
			} else {
				
				var img = image;
				str = "<h1>Image: " + img + "   Status: " + xhr.status + "</h1>";
				target.innerHTML = str;
				window.console.log(str);
			}
		}
	};
	

	// initialise a request, specifying the HTTP method
	// to be used and the URL to be connected to.
	// variables are assigned above the xhr.open
	
	
	var image = document.getElementById('img').value;
	
	
	var stringToPass = "image=" + image;
	
	
	xhr.open("POST", "./scripts/item_image_upload.php", true);
	
	
	
	xhr.onreadystatechange = changeListener;
	xhr.send(stringToPass);
	
	return false;

};