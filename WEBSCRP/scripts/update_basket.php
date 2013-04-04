<?php
	include "executeQuery.php";
	include "getData.php";
						
	if (!isset($_SESSION['basket'])){
		include "classes/basket.php"; // catch for ajax loads
		session_start();
	}
	
	$basket = $_SESSION['basket'];
	
	$itemID = $_GET['itemID'];
	$newQuan = $_GET['quantity'];
	$isValid = false; // validitiy flag
	
	if (is_numeric($newQuan)){
		$isValid = true;
		$itemID = intval($itemID);
		$newQuan = intval($newQuan);
	}
	
	if ($isValid){
		// variables are valid, any update code goes here
		if($newQuan == 0){
		 // quantity has been set as zero, delete item!
			$basket->removeItem($itemID);
		} else {
			// value is not zero
			$basket->updateQuantity($itemID, $newQuan);
		}
		
	
	
	}
	
	$_SESSION['basket'] = $basket; // update basket
		
?>
		