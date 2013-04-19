
<?php


	echo "<form action='buy.php' class='left' method='get'>";
	
	echo "<h3>" . $row['itemName'];
	echo "</h3>";
	
	
	$itemID = $row['itemID']; // id
	$img = $row['image'];
	
	echo "<div class='browsePicture'>";
	if ($img != "none" && $img != ""){
		echo "<img src='$img' class='itemImage'></img>";
	} else {
		echo "<img src='img/no_img.png' class='itemImage'></img>"; // 'no image defined'
	}
	
	
	echo "</div>";
	
	
	echo "<p> £" . $row['itemPrice'] . "</p>";
	
	
	echo "<input type='hidden' name='itemID' value='$itemID'>";
	
	
	echo "</form>";

?>