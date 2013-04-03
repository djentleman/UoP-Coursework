<?php
	// Basket class
	
	class Basket{
	
		public $itemIDs = array(); // array of all item IDs, UNIQUE
		public $quantities = array();// array of all quantities, NOT UNIQUE
		// refresrece with array index, for instance the ID at index 3, has the quantity
		// held at index 3
		
		public function __construct(){
			// contructs an empty basket
			$this->itemIDs = array();
			$this->quantities = array();
			// initlize both as empty array
		}
		
		public function getSize(){
			return count($this->itemIDs);
		}
		
		public function getQuantity($reference){
			// refrerence obtained by linear search (foreach)
			return $this->quantities[$reference];
		}
		
		private function findReference($itemID){
			// returns index of itemID
			// returns -1 for non existant IDs
			$count = 0; // increments with loop
			foreach ($this->itemIDs as &$currentID){
				if ($currentID == $itemID){
					return $count;
				}
				$count++;
			}
			return $count; // not found	
		}
		
		public function addItem($itemID, $quantity){
			// check if itemID is already registered
			if (in_array($itemID, $this->itemIDs)){
				//item is already in the array, add quantity to current quantity
				$index = $this->findReference($itemID);
				if ($index != -1){
					// it will exist (in_array), no need for an else
					$this->quantities[$index] += $quantity;
				}
			} else {
				array_push($this->itemIDs, $itemID);
				array_push($this->quantities, $quantity);
			}
		}
		
		public function removeItem($itemID){
			//delete item here
		}
		
		public function dump(){
			$this->itemIDs = array();
			$this->quantities = array();
			// removes everything
		}
		
		public function printOut(){
			// general debugger
			echo "IDs:";
			if (empty($this->itemIDs)){
				echo "No IDS";
			} else {
				foreach ($this->itemIDs as &$currentID){
					echo $currentID;
					echo ", ";
				}
			}
			
			echo "Quantities:";
			if (empty($this->quantities)){
				echo "No Items";
			} else {
				foreach ($this->quantities as &$currentQuan){
					echo $currentQuan;
					echo ", ";
				}
			}
		}
		
		
	
	}

?>