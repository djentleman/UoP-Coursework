<div id="catForm" class="rightDiv">
				<p class="left"> Select a Catagory</p>
				<!--  action="delete_complete.php" OLD -->
				<form class="left" method="post">
					<?php
						
						include "mysql.php";
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con); // catagoryID is del variable name
						
						
						mysql_close($con);
					?>
	
					<button onclick="return name=del(true)">Submit</button>
					
				</form>
			</div>