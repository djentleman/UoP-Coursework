<?php
	$col = "FFFFFF";
	if (isset($_GET['colour'])){
		$col = $_GET['colour'];
	}
	$light1 = "";
	$light2 = "";
	$whiteFlag = true; // if whiteFlag is true, the header will have white text
	//col is the darker colour, to get the lighter colour, edit the CSS FC8 -> FD9 -> FEA
	
	function generateObject($object, $attribute, $hex){
		$str = "";
		$str .= $object . "{" . $attribute . ":" . $hex . ";" . "}";
		return $str;
	}
	
	
	
	function increment($char){
		if ($char == "0"){
			return "1";
		} else if ($char == "1"){
			return "2";
		} else if ($char == "2"){
			return "3";
		} else if ($char == "3"){
			return "4";
		} else if ($char == "4"){
			return "5";
		} else if ($char == "5"){
			return "6";
		} else if ($char == "6"){
			return "7";
		} else if ($char == "7"){
			return "8";
		} else if ($char == "8"){
			return "9";
		} else if ($char == "9"){
			return "A";
		} else if ($char == "A"){
			return "B";
		} else if ($char == "B"){
			return "C";
		} else if ($char == "C"){
			return "D";
		} else if ($char == "D"){
			return "E";
		} else {
			return "F";
		}
	}
	
	for($i = 0; $i < 6; $i++){ // format [1][2][3][4][5][6]
		$light1 .= increment($col[$i]);
	}
	for($i = 0; $i < 6; $i++){ // format [1][2][3][4][5][6]
		$light2 .= increment($light1[$i]);
	}
	
	
	// in order to calculate the white flag, it needs to be worked out of the colour is 'dark'
	// hex colours are laid out  {red:[MSB][LSB]}{green:[MSB][LSB]}{blue:[MSB][LSB]}
	// in order to see red properly with black text, the MSB (0) needs to be over 6
	// in order to see red properly with black text, the MSB (2) needs to be over 5
	// in order to see red properly with black text, the MSB (4) needs to be over 9
	
	$redMSB = $col[0];
	$greenMSB = $col[2];
	$blueMSB = $col[4];
	
	if (!is_numeric($blueMSB)){
		$whiteFlag = false;
		//if any MSB is not a number, then black text will be readable
	} // no need for else
	
	if (!is_numeric($redMSB)){
		$whiteFlag = false;
	} else {
		$redMSB = intval($redMSB);
		if ($redMSB > 5){
			$whiteFlag = false;
		}
	}
	
	if (!is_numeric($greenMSB)){
		$whiteFlag = false;
	} else {
		$greenMSB = intval($greenMSB);
		if ($greenMSB > 4){
			$whiteFlag = false;
		}
	}
	
	
	$col = "#" . $col;
	$light1 = "#" . $light1;
	$light2 = "#" . $light2;
	
	
	
	
	$css = "";
	$css .= generateObject("body", "background-color", $light2);
	$css .= generateObject(".searchSuggestion:hover", "background-color", $light1);
	$css .= generateObject(".itemNameWrap:active", "background-color", $light2);
	$css .= generateObject(".itemNameWrap:hover", "background-color", $light1);
	$css .= generateObject(".addStock:active", "background-color", $light2);
	$css .= generateObject(".addStock:hover", "background-color", $light1);
	$css .= generateObject(".stockIdWrap:active", "background-color", $light2);
	$css .= generateObject(".stockIdWrap:hover", "background-color", $light1);
	$css .= generateObject(".leftButton", "background-color", $light1);
	$css .= generateObject(".leftButton:hover", "background-color", $light2);
	$css .= generateObject(".rightButton", "background-color", $light1);
	$css .= generateObject(".rightButton:hover", "background-color", $light2);
	$css .= generateObject(".choiceObject:hover", "background-color", $light1);
	$css .= generateObject(".choiceObject:active", "background-color", $light2);
	$css .= generateObject(".updateButton:hover", "background-color", $light1);
	$css .= generateObject(".updateButton:active", "background-color", $light2);
	$css .= generateObject(".basketIdWrap:hover", "background-color", $light1);
	$css .= generateObject(".basketIdWrap:active", "background-color", $light2);
	$css .= generateObject(".browseDiv:hover", "box-shadow", "0px 0px 8px " . $light1);
	$css .= generateObject(".browseDiv:active", "box-shadow", "0px 0px 12px " . $col);
	$css .= generateObject(".menuCase", "background", $col);
	$css .= generateObject("ul li a:hover", "background", $light1);
	$css .= generateObject("li:hover a", "background", $light1);
	$css .= generateObject("li:hover li a:hover", "background", $col);
	$css .= generateObject("header", "background-color", $col);
	$css .= generateObject(".dragBox ", "background", $light1);
	$css .= generateObject(".dragBox:hover", "background", $col);
	if ($whiteFlag){
		$css .= generateObject("header", "color", "#FFFFFF");
		$css .= generateObject(".logo", "color", "#FFFFFF");
		$css .= generateObject(".menuCase", "color", "#FFFFFF");
		$css .= generateObject(".menuCase", "border-left", "1px solid #FFFFFF");
		$css .= generateObject(".rightButton", "color", "#FFFFFF");
		$css .= generateObject(".leftButton", "color", "#FFFFFF");
		$css .= generateObject(".basketIdWrap:hover", "color", "#FFFFFF");
		$css .= generateObject(".basketIdWrap:active", "color", "#FFFFFF");
		$css .= generateObject(".choiceObject:hover", "color", "#FFFFFF");
		$css .= generateObject(".choiceObject:active", "color", "#FFFFFF");
		$css .= generateObject(".searchSuggestion:hover", "color", "#FFFFFF");
		$css .= generateObject(".itemNameWrap:hover", "color", "#FFFFFF");
		$css .= generateObject(".itemnameWrap:active", "color", "#FFFFFF");
		$css .= generateObject(".addStock:active", "color", "#FFFFFF");
		$css .= generateObject(".addStock:hover", "color", "#FFFFFF");
		$css .= generateObject(".stockIdWrap:active", "color", "#FFFFFF");
		$css .= generateObject(".stockIdWrap:hover", "color", "#FFFFFF");
		
	}	
	
	echo $css; // generated css
	$filepath = "../css/dynamic.css"; // file to write to
	
	// write $css to dynamic.css
	
	
	file_put_contents ($filepath, $css); //write to file
?>