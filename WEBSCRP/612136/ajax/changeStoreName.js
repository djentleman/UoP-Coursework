function changeName() {
	//uploads new store name

	var xhr, target, changeListener;
	
	
	target = document.getElementById("validationCallback");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				

				target.innerHTML = "Store Name Successfully Updated";
				document.getElementById('logo').innerHTML = storeName;

			} else {
				target.innerHTML = "<p>Something Went Wrong</p>";
			}
		} else if (xhr.readyState != 0 && xhr.readyState != 4){
			//target.innerHTML = "<p> Loading... </p>";
		}
	};
	
	var storeName = document.getElementById('storeName').value;
	
	var stringToPass = "?storeName=" + storeName;

	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "../scripts/changeStoreName.php" + stringToPass, true);
	xhr.send();
	
	
	
	return false; //stops page from refreshing
	
};