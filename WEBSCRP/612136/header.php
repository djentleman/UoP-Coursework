<?php include "/scripts/classes/basket.php"; session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tbuyer </title>
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<link rel="stylesheet" type="text/css" href="css/Tbuyer.css">
		<script src="ajax/reset.js"></script> <!-- AJAX for DB reset -->
		<script src="js/form_browse.js"></script> <!-- JS for browse -->
		
		
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
					<a href="index.php" ><img class="logo" style="margin-top:5px" src="img/Tbuyer.png"></a></img>
					<li><a class="menuCase" style="margin-top:10px" href="basket.php">Basket</a></li>
					<li><h2 style="margin-top:10px; margin-right:20px;">Customer</h2></li>
				</ul>
			</nav>
			<form class="searchForm" action="browse.php"> <!-- action still needs to be 'beowse.php' -->
				<div class="search headerSearch">
					<input type="text" id="searchValue" name="search" value="">
					<button onclick="browse()">Search</button> <!-- USES JS NOW -->
					<!--<input type="submit" name="submit" value="Search"> -->
				</div>
			</form>
			
		</header>