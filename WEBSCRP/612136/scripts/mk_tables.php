<?php
				//create the catagories table
				$query = "CREATE TABLE `catagories` (`catagoryID` int(10) NOT NULL AUTO_INCREMENT, `catagoryName` varchar(30), 
					PRIMARY KEY(`catagoryID`))";
				execute($query, $con);
				
				//create the items table
				// add end date?
				$query = "CREATE TABLE `items`(`itemID` int(10) NOT NULL AUTO_INCREMENT, `itemName` varchar(30), `itemQuantity` int(10),
					`itemPrice` decimal(10, 2), `sellerName` varchar(50), `isNew` int(1), 
					`tags` varchar(200), `itemDescription` TEXT, `image` varchar(200), `searchRelevance` int(100), `catagoryID` int(10), `averageRating` decimal(5, 1),
					PRIMARY KEY(`itemID`))";
				// FOREIGN KEY(`catagoryID`) REFERENCES catagories(`catagoryID`)?
				// search relevance is a rating of the tasks relevance
				//image is directory
				//tags is a big list seperated by commas
				// if isNew isn't 0, then it's false
				execute($query, $con);
				
				//create the comments table
				$query = "CREATE TABLE `comments` (`commentID` int(10) NOT NULL AUTO_INCREMENT, `posterName` varchar(30),
					`commentBody` varchar(1000), `rating` int(10), `replied` int(1), `itemID` int(10), 
					PRIMARY KEY(`commentID`))";
				execute($query, $con);
				// if replied = 0 then true, else false
				
				$query = "CREATE TABLE `orders` (`orderID` int(10) NOT NULL AUTO_INCREMENT, `orderQuantity` int(10), `buyerName` varchar(30),
					`buyerAddress` varchar(1000), `buyerPostcode` varchar(10), `buyerEmail` varchar(80), `buyerPhoneNo` varchar(12), `itemID` int(10), 
					PRIMARY KEY(`orderID`))";
				execute($query, $con);
?>