<?php
	$itemID = $_GET['itemID'];
	
	include "mysql.php";
	
	$con = mysql_connect("localhost","root"); 
	$query = "USE `tbuyer`";
	executeQuery($query, $con); // use tbuyer
	
	$query = "SELECT * FROM `items` WHERE `itemID` = '$itemID'";
	$dataArr = getData($query, $con);
	
	mysql_close($con);
	
	echo $dataArr[1]; // stock level
	
?>
