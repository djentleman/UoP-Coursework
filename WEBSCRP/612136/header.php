<?php include "scripts/classes/basket.php"; session_start(); 
	if (!isset($_SESSION['basket'])){
		$_SESSION['basket'] = new Basket;
	}
	if (!isset($_SESSION['storeName'])){
		$_SESSION['storeName'] = file_get_contents('assets/storeName.txt');
	}
	if (!isset($_SESSION['currency'])){
		$_SESSION['currency'] = file_get_contents('assets/currency.txt');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tbuyer </title>
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<link rel="stylesheet" type="text/css" href="css/Tbuyer.css">
		<link id="DCSS" rel="stylesheet" type="text/css" href="css/dynamic.css">
		<script src="js/form_browse.js"></script> <!-- JS for browse -->
		<script src="js/form_buy.js"></script> <!-- JS for browse -->
		<script src="ajax/searchSuggestions.js"></script> <!-- AJAX for search suggestions -->
		<script>
			function removeSuggestions(){
				setTimeout(function(){document.getElementById('suggestions').innerHTML = ""}, 300);
				//document.getElementById('suggestions').innerHTML = "";
				return false;
			}
		</script>
		
		
	</head>
	
	<script>
		function confirmAction(){
			var confirmed = confirm("Are you sure you want to delete the current database and make a new one?");
			if(confirmed){
				return reset()
			} else
			{
				alert("The Database Has Not Been Reset");
			}
			return false
		}
	</script>
	
	<body>
		<header>
			<nav>
				<ul>
					<?php
						$storeName = $_SESSION['storeName'];
						echo "<a href='index.php' ><h1 id='logo' class='logo'>$storeName</h1></a>";
					?>
					<li><a class="menuCase" style="margin-top:10px">Log In</a>
					<ul>
						<li><a class="menuCase" href="admin/">Admin</a></li>
						<li><a class="menuCase" href="cms/">CMS</a></li>
					</ul>
					<li><a class="menuCase" style="margin-top:10px" href="basket.php">Basket</a></li>
					<li><h2 style="margin-top:10px; margin-right:20px;">Customer</h2></li>
				</ul>
			</nav>
			<form autocomplete="off" class="searchForm" action="browse.php"> <!-- action still needs to be 'beowse.php' -->
				<div class="search headerSearch">
					<input onkeyup="return getSuggestions()" onblur="return removeSuggestions()" style="width:140px" type="text" id="searchValue" name="search" value="">
					<button onclick="browse()">Search</button> <!-- USES JS NOW -->
					<!--<input type="submit" name="submit" value="Search"> -->
				</div>
			</form>
			
		</header>
		
		<div id="suggestions">
			<!--<p class="searchSuggestion">desktop</p>
			<p style="margin-top:-20px" class="searchSuggestion">laptop</p>
			<p style="margin-top:0px" class="searchSuggestion">usb stick</p>-->
		</div>
		
		<?php
			
			include "scripts/db_auto_create.php";
			
		?>