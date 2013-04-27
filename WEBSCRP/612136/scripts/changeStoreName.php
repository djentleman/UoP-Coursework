<?php
	session_start(); //just checking
	$_SESSION['storeName'] = $_GET['storeName'];
	$filepath = "../assets/storeName.txt";
	file_put_contents ($filepath, $_SESSION['storeName']);
?>