
			
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
				
				include "mk_tables.php";
				
				echo "callback: database set up success";
				
				mysql_close($con);
				
?>
