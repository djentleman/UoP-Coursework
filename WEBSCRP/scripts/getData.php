<?php
	
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
									$row['itemDescription'], $row['image'], $row['inBasket'], 
									$row['catagoryID']]; // array of everything 
				
		}
		else{
			echo mysql_error();
		}
		return [null];
	}
?>