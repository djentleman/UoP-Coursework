<?php
	include "mysql.php";
	$currentQuery = $_GET['search'];
	
	function getSuggestions($con, $search){
		$search = strtolower($search); // not case sensitive
		$query = "SELECT * FROM `items`";
		if ($search == ""){
			return false;
		}
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if (mysql_query($query ,$con)){
			$output = (mysql_query($query ,$con));
			$currentPos = -40;
			while($row = mysql_fetch_array($output)){
				// if this string is the beggining of itemName, echo suggestion
				$itemName = strtolower($row['itemName']);
				$itemID = $row['itemID'];
				
				$success = false;
				if (strpos($itemName,$search) !== false) {
					$success = true;
				}
				if ($success && $currentPos < 121){ // limited to 6 suggestions
					// render suggested item
					$pos = $currentPos . "px";
					echo "<p onclick='goToBuy($itemID)' class='searchSuggestion' style='margin-top:$pos'>$itemName</p>";
				
					$currentPos += 20; // move down
				}
				
			}						
		}
		else{
			echo mysql_error();
		}
		
	}
	
	
	$con = mysql_connect("localhost","root");
	
	
	$query = "USE `tbuyer`";
	executeQuery($query, $con);
	
	getSuggestions($con, $currentQuery);
	
	mysql_close($con);
	
?>