
function browse(){
// uses JS to load browse page (execute php GET)
// this stops the submit button being a GET parameter (do not want)
	
	var search = document.getElementById('searchValue').value
	var stringToPass = "?search=" + search; // contruct GET string
	location = "browse.php" + stringToPass; // changes page
};

