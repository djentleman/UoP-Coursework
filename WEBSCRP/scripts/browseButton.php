
<?php
	echo "<p>" . $row['itemName'];
	echo "</p>";
	echo "<form action='buy.php' method='get'>";
	//define variable
	$itemID = $row['itemID']; // id
	
	
	echo "<input type='hidden' name='itemID' value='$itemID'>";
									
	echo "<input type='submit' name='submit' value='Buy Item'>";
	echo "</form>";

?>