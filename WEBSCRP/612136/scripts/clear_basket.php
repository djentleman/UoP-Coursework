<?php
	if (!isset($_SESSION['basket'])){
		include "classes/basket.php";
		session_start();
	}
	$_SESSION['basket'] = new Basket(); // clears basket
?>