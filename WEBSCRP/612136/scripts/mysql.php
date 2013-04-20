<?php


//Execute Query Function
//UPDATE, DELETE & CREATE all use this code

function executeQuery($query, $con){
					
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if (mysql_query($query ,$con)){
		//echo "Command Executed.";
	}
	else{
		echo "<h3>The Shop Database Isn't Set Up Yet</h3>";
		echo "<h3>Click Reset Database On The CMS Panel To Fix This Problem</h3>";
		echo mysql_error();
	}
}

function getData($query, $con){	
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if (mysql_query($query ,$con)){
		$output = (mysql_query($query ,$con));
		while($row = mysql_fetch_array($output))
			// there should only be one row
			return [$row['itemName'], $row['itemQuantity'], $row['itemPrice'],
								$row['sellerName'], $row['isNew'], $row['tags'], 
								$row['itemDescription'], $row['image'], $row['searchRelevance'], 
								$row['catagoryID']]; // array of everything 
				
	}
	else{
		echo mysql_error();
	}
	return array();
}

function getCatName($catId, $con){	
	$query = "SELECT * FROM `catagories` WHERE `catagoryID` = '$catId'";
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if (mysql_query($query ,$con)){
		$output = (mysql_query($query ,$con));
		while($row = mysql_fetch_array($output))
			// there should only be one row
			return $row['catagoryName'];
				
	}
	else{
		echo mysql_error();
	}
	return "No Category";
}

function renderListBox($query, $con){
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if (mysql_query($query ,$con)){
		//render list box
								
								
		$output = (mysql_query($query ,$con));
								
		echo "<select id='itemList' name='itemID'>";
		// list box name is ID
		//list box JS ID is always 'list'
								
		while($row = mysql_fetch_array($output)){
			$val = $row['itemID'];
			$nam = $row['itemName'];
			echo "<option value=$val>$nam</option>";
		}
		echo "</select>";
	}
	else{
		echo mysql_error();
	}
}
						
						
						

// used for 'catagories'
function renderListBoxCat($query, $con){
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if (mysql_query($query ,$con)){
		//render list box
								
								
		$output = (mysql_query($query ,$con));
								
		echo "<select id='catagoryList' name='catagoryID'>";
								
		while($row = mysql_fetch_array($output)){
			$val = $row['catagoryID'];
			$nam = $row['catagoryName'];
			echo "<option value=$val>$nam</option>";
		}
							
		echo "</select>";
								
	}
	else{
		echo mysql_error();
	}
}
						
function renderListBoxCatEmpty($query, $con){
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if (mysql_query($query ,$con)){
		//render list box
								
								
		$output = (mysql_query($query ,$con));
								
		echo "<select id='catagoryList' name='catagoryID'>";
		echo "<option value='-1'>No Catagory</option>"; // -1 fits with search filter
								
		while($row = mysql_fetch_array($output)){
			$val = $row['catagoryID'];
			$nam = $row['catagoryName'];
			echo "<option value=$val>$nam</option>";
		}
									
								
								
		echo "</select>";
								
	}
	else{
		echo mysql_error();
	}
}



























?>