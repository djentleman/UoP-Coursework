<?php



	function canBuy($con){
		
		$basketSize = $_GET['basketSize'];
		$canBuy = true; // quantity error flag
		for ($i = 0; $i < $basketSize; $i++){
			$idReq = "id" . $i; // id request
			$quanReq = "quan" . $i; // quantity request
			$itemID = $_GET[$idReq];
			$quantity = $_GET[$quanReq];
			
			// get the available quantity of the item
			
			$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
			$dataArray = getData($query, $con);
			
			$totalQuantity = $dataArray[1];
			$itemName = $dataArray[0];
			
			
			$newQuantity = $totalQuantity - $quantity;
			
			if ($newQuantity < 0){
				// not enough stock
				$canBuy = false;
				echo("Not Enough '$itemName' Stock In The Store");
				echo "<br>";
			} 
		}
		return $canBuy;
	}


	header("JSON: " . json_encode($_GET));  // debug
	
	include "mysql.php";
	$con = mysql_connect("localhost","root"); // will be querying item IDs
	$query = "USE `tbuyer`";
	executeQuery($query, $con); // use tbuyer
	
	$basketSize = $_GET['basketSize'];
	
	// size of the basket
	
	
	if ($basketSize == 0){
		echo "Basket Is Empty, Nothing To Buy";
	} else {
		// stock control happens here
		
		$canBuy = canBuy($con);
		
		if (!$canBuy){
			die();
		} else {
			// control stock
			for ($i = 0; $i < $basketSize; $i++){
				$idReq = "id" . $i; // id request
				$quanReq = "quan" . $i; // quantity request
				$itemID = $_GET[$idReq];
				$quantity = $_GET[$quanReq];
				
				// get the available quantity of the item
				
				$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
				$dataArray = getData($query, $con);
				
				$totalQuantity = $dataArray[1];
				$itemName = $dataArray[0];
				
				
				$newQuantity = $totalQuantity - $quantity;
				
				
					
				$query = "UPDATE `items`
				SET `itemQuantity`='$newQuantity'
				WHERE `itemID`='$itemID'";
				executeQuery($query, $con);

			}
		
			echo "Transaction Complete";
		}
	
	}
	
	mysql_close($con);
?>