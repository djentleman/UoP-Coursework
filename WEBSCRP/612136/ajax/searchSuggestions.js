


function getSuggestions() {
	var xhr, target, changeListener;
	
	
	target = document.getElementById("suggestions");

	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				
				target.innerHTML = xhr.responseText;

			}
		}
	};

	var search = document.getElementById('searchValue').value;
	
	var stringToPass = "?search=" + search;

	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "./scripts/getSuggestedSearch.php" + stringToPass, true);
	xhr.send();
	
	
	
	return false; //stops page from refreshing
	
};


