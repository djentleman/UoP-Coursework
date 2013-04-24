<?php include "scripts/classes/basket.php"; session_start(); 
	if (!isset($_SESSION['basket'])){
		$_SESSION['basket'] = new Basket;
	}
	if (!isset($_SESSION['storeName'])){
		$_SESSION['storeName'] = "Tbuyer";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tbuyer </title>
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<link rel="stylesheet" type="text/css" href="css/Tbuyer.css">
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
					<input style="width:140px" type="text" id="searchValue" name="search" value="">
					<button onclick="browse()">Search</button> <!-- USES JS NOW -->
					<!--<input type="submit" name="submit" value="Search"> -->
				</div>
			</form>
			
		</header>
		
		<div id="suggestions">
			<p class="searchSuggestion">desktop</p>
			<p style="margin-top:-20px" class="searchSuggestion">laptop</p>
			<p style="margin-top:0px" class="searchSuggestion">usb stick</p>
		</div>
		
		<?php
		
			function execute($query, $con){
				if (!$con){
					die('Could not connect: ' . mysql_error());
				}
				if (mysql_query($query ,$con)){
					//echo "Command Executed.";
				}
				else{
					//echo "<h3>The Shop Database Isn't Set Up Yet</h3>";
					//echo "<h3>Click Reset Database On The CMS Panel To Fix This Problem</h3>";
					//echo mysql_error();
				}
			}
		
			function testDatabase(){
				$con = mysql_connect("localhost","root");
				$query = "USE `tbuyer`";
				if (!$con){
					return false;
				}
				if (mysql_query($query ,$con)){
					return true;
				}
				else{
					return false;
				}
				mysql_close($con);
			}
			
			
			$isSet = testDatabase();
			if($isSet == false){
				// data base isn't set up
				
				$con = mysql_connect("localhost","root");
				
				$query = "DROP DATABASE IF EXISTS `tbuyer`";
				execute($query, $con);
				
				$query = "CREATE DATABASE `tbuyer`";
				execute($query, $con);
				
				//the database has catagories, comments, images and items
				//one catagory can have many items
				// one item can have many comments
				
				$query = "USE `tbuyer`";
				execute($query, $con);
				
				//create the catagories table
				$query = "CREATE TABLE `catagories` (`catagoryID` int(10) NOT NULL AUTO_INCREMENT, `catagoryName` varchar(30), 
					PRIMARY KEY(`catagoryID`))";
				execute($query, $con);
				
				//create the items table
				// add end date?
				$query = "CREATE TABLE `items`(`itemID` int(10) NOT NULL AUTO_INCREMENT, `itemName` varchar(30), `itemQuantity` int(10),
					`itemPrice` float(10), `sellerName` varchar(50), `isNew` int(1), 
					`tags` varchar(200), `itemDescription` varchar(1000), `image` varchar(200), `searchRelevance` int(100), `catagoryID` int(10),
					PRIMARY KEY(`itemID`))";
				// FOREIGN KEY(`catagoryID`) REFERENCES catagories(`catagoryID`)?
				// search relevance is a rating of the tasks relevance
				//image is directory
				//tags is a big list seperated by commas
				// if isNew isn't 0, then it's false
				execute($query, $con);
				
				//create the comments table
				$query = "CREATE TABLE `comments` (`commentID` int(10) NOT NULL AUTO_INCREMENT, `posterName` varchar(30),
					`commentBody` varchar(1000), `itemID` int(10), 
					PRIMARY KEY(`commentID`))";
				execute($query, $con);
				
				$query = "CREATE TABLE `orders` (`orderID` int(10) NOT NULL AUTO_INCREMENT, `orderQuantity` int(10), `buyerName` varchar(30),
					`buyerAddress` varchar(1000), `buyerPostcode` varchar(10), `buyerEmail` varchar(80), `buyerPhoneNo` varchar(12), `itemID` int(10), 
					PRIMARY KEY(`orderID`))";
				execute($query, $con);
				
				
				mysql_close($con);
				
			}
			
				
			//auto setup
			
		?>