
function goToBuy(itemID, isAdmin){
	var stringToPass = "?itemID=" + itemID; // contruct GET string
	if (isAdmin){
		location = "../buy.php" + stringToPass; // changes page
	} else {
		location = "buy.php" + stringToPass; // changes page
	}
};

