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
				
				
				include "mk_tables.php";
				
				
				mysql_close($con);
				
				$_SESSION['basket'] = new Basket();
				
			}
			
			
				
			//auto setup


?>