// Upload New Comment w/ Ajax


function uploadAndRefresh(){
	uploadCom(); // uploads new comment
	//refresh(); // refreshes current comments
	return false; // prevent refresh
}


function uploadCom() {
	//uploads new comment

	

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("dynamicText");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				

				refresh(); // Comment would have been added (200 returned), then refresh page
				//target.innerHTML = "<p>Comment Added Successfully!</p>";

			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
			//target.innerHTML = "<p> Loading... </p>";
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

function refresh(){
	//re-renders comments
	
	
	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("comments");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				


				target.innerHTML = xhr.responseText; // rendered text from php

			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
			target.innerHTML = target.innerHTML + "<br><p> Loading... </p>";
		}
	};
	

	var itemID = document.getElementById('itemID').value;
	var stringToPass = "?itemID=" + itemID;
	

	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/fetch_comments.php" + stringToPass, true);
	xhr.send();
	
	return false; //stops page from refreshing


};

