
			
<?php			
				
				$GLOBALS = $GLOBALS+$_REQUEST;
				
				function execute($query, $con){
					
				if (!$con){
					die('Could not connect: ' . mysql_error());
				}
				if (mysql_query($query ,$con)){
					//echo "Command Executed.";
				}
				else{
					echo "<h3>The Shop Database Isn't Set Up Yet</h3>";
					echo "<h3>Click Reset Database On The CMS Panel To Fix This Problem</h3>";
					echo mysql_error();
				}
}
				
				// reset basket
				include "clear_basket.php"; // catch for ajax loads
	
				
				function clearImgDir(){
					$dirname = "../img/uploads";
					$filesToDelete = $dirname . "/*";
					// empty the directory
					$files = glob($filesToDelete); // get file names
					foreach($files as $file){ // iterate files
						if(is_file($file)){ // if file exists
							unlink($file); // delete file	
						}						
					}
				
					// delete image directory
					
					//$_SERVER['DOCUMENT_ROOT'] . "/cw/img/uploads/";
					
					//header("x-debug1: '$dirname'");
					//header("x-debug2: '$filesToDelete'");
					
					rmdir($dirname);
				
					// remake image dir
					mkdir($dirname);
				
				}
				
				clearImgDir();
				
				// connections must be open while above function is executed
				
				$con = mysql_connect("localhost","root");
				
				//delete current database
				$query = "DROP DATABASE IF EXISTS `tbuyer`";
				try{
					execute($query, $con);
				}
				catch (Exception $e){
					//nothing
				}
				
				
				
				
				//create new database
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
					`itemPrice` decimal(10, 2), `sellerName` varchar(50), `isNew` int(1), 
					`tags` varchar(200), `itemDescription` varchar(1000), `image` varchar(200), `searchRelevance` int(100), `catagoryID` int(10), `averageRating` decimal(5, 1),
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
				
				echo "callback: database set up success";
				
				mysql_close($con);
				
?>
