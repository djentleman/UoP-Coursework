<?php

	function search_for($str, $search){
		$str = str_replace(",", "", $str);
		$str = strtolower($str); // set to lower case
		$search = strtolower($search);
		$strArr = explode(" ", $str);
		foreach ($strArr as &$currentStr){
			if ($search == $currentStr){
				return true;
			}
		}
		return false;
	}
?>