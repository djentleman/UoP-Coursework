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
					`tags` varchar(200), `itemDescription` varchar(1000), `image` varchar(200), `searchRelevance` int(100), `catagoryID` int(10), `averageRating`  decimal(5, 1),
					PRIMARY KEY(`itemID`))";
				// FOREIGN KEY(`catagoryID`) REFERENCES catagories(`catagoryID`)?
				// search relevance is a rating of the tasks relevance
				//image is directory
				//tags is a big list seperated by commas
				// if isNew isn't 0, then it's false
				execute($query, $con);
				
				//create the comments table
				$query = "CREATE TABLE `comments` (`commentID` int(10) NOT NULL AUTO_INCREMENT, `posterName` varchar(30),
					`commentBody` varchar(1000), `rating` int(10), `itemID` int(10), 
					PRIMARY KEY(`commentID`))";
				execute($query, $con);
				
				$query = "CREATE TABLE `orders` (`orderID` int(10) NOT NULL AUTO_INCREMENT, `orderQuantity` int(10), `buyerName` varchar(30),
					`buyerAddress` varchar(1000), `buyerPostcode` varchar(10), `buyerEmail` varchar(80), `buyerPhoneNo` varchar(12), `itemID` int(10), 
					PRIMARY KEY(`orderID`))";
				execute($query, $con);
				
				
				mysql_close($con);
				
				$_SESSION['basket'] = new Basket();
				
			}
			
			
				
			//auto setup


?>