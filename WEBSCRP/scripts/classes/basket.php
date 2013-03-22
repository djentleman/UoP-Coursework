<?php
	// Basket class
	
	class Basket{
	
		private $itemIDs; // array of all item IDs, UNIQUE
		private $quantities; // array of all quantities, NOT UNIQUE
		// refresrece with array index, for instance the ID at index 3, has the quantity
		// held at index 3
		
		function __construct(){
			// contructs an empty basket
			$itemIDs = array();
			$quantities = array();
			// initlize both as empty array
		}
		
		function getItemIDs(){
			return $itemIDs;
		}
		
		function getQuantities(){
			return $quantities;
		}
		
		function getQuantity($itemID){
			return $quantities[$itemID];
		}
		
		function addItem($itemID, $quantity){
			array_push($itemIDs, $itemID);
			array_push($quantities, $quantity);
		}
		
	
	}

?>