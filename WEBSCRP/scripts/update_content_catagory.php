<div id="catForm" class="rightDiv">
				<p class="left"> Select a Catagory</p>
				<!-- action="update_catagory.php" -->

				
				<form class="left">
				
					
					<?php
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						include "mysql.php";
						
						// renders list box
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con);
						
						mysql_close($con);
					?>
					
					
					<p>Catagory Name*</p>
					<input type="text" id="catName" name="catagoryName" value="">
					
					<input type="button" name="submit" value="Submit" onclick="return editCat()">
					
				</form>
			</div>