<?php

	function search_for($str, $search){
					$strLen = length($str);
					$subLen = length($search);
					$end = $strLen - $subLen; //the last point the pointer $i needs to point to
					$success = false; //boolean whether search has been successful or not
					
					
					for ($i = 0;$i <= $end; $i++){
					
						//echo "$i";
						$currentSearch = "";
						for ($j = 0; $j < $subLen; $j++){
							$currentSearch .= $str{$j + $i}; //adds current char to currentSearch
						}
						
						//echo "$currentSearch";
						//echo "    ";
						//echo "$search";
						//echo "     ";
						//currentSearch is now a complete string
						if(strtolower($currentSearch) == strtolower($search)){ 
							//echo"SEARCH SUCCESFUL";
							return true;
						}
					
					}
					return false;
				}
?>