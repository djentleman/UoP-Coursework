function renderStep2() {

	document.getElementById("dragtarget").style.visibility = 'visible';

	// declare the two variables that will be used
	var xhr, target, changeListener;
	
	
	target = document.getElementById("dynamic");

	// create a request object
	xhr = new XMLHttpRequest();

	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				
				target.innerHTML = xhr.responseText;
				
			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		}
	};
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/upload_item_step_2.php", true);
	xhr.send();
	
	return false; //stops page from refreshing
	
	

};