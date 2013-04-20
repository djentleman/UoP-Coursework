<?php

	function search_for($str, $search){
		$str = strtolower($str);
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