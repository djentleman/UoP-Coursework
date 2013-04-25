// DCSS!!!

function changeCSS(isAdvanced) {

	var xhr, target, changeListener;
	target = document.getElementById("DCSS");

	// create a request object
	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				target.innerHTML = ""; // makes sure it refreshes
				target.innerHTML = "<link rel='stylesheet' type='text/css' href='../css/dynamic.css'>";
				// update css with ajax
			}
		}
	};
	if (isAdvanced){
		var colour = document.getElementById('hex').value;
	} else {
		var colour = document.getElementById('colourSelect').value;
	}
	
	
	var stringToPass = "?colour=" + colour;
	
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "../scripts/generateDCSS.php" + stringToPass, true);
	xhr.send();
	
	
	
	return false; //stops page from refreshing
	
};
