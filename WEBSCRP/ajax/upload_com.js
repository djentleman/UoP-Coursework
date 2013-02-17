// Upload New Comment w/ Ajax


function uploadCom() {
	//alert("hello");

	

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("dynamicText");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				


				target.innerHTML = "<p>Your Comment Has Been Added:</p>";
				target = document.getElementById("dynamicText1");
				target.innerHTML = document.getElementById('comment').value;
				
				
				
				
			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		}
	};
	
	
	
	
	var itemID = document.getElementById('itemID').value;
	var posterName = document.getElementById('posterName').value;
	var comment = document.getElementById('comment').value;
	
	
	
	var stringToPass = "?itemID=" + itemID + "&posterName=" + posterName + "&comment=" + comment;
	
	
	
	
	
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/comment_upload_complete.php" + stringToPass, true);
	xhr.send();
	
	return false; //stops page from refreshing
	
	

};