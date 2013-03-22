
function goToBuy(itemID){
	var stringToPass = "?itemID=" + itemID; // contruct GET string
	location = "buy.php" + stringToPass; // changes page
};

