


function getSuggestions() {
	var xhr, target, changeListener;
	
	
	target = document.getElementById("suggestions");

	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				
				target.innerHTML = xhr.responseText;

			}
		} else if (xhr.readyState != 0){
			// loading
			if (target.innerHTML != ""){ // stops it loading when there is nothing to load
				target.innerHTML = "<p class='searchSuggestion'>Loading...</p>";
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


