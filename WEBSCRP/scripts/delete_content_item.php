<div id="itemForm" class="leftDiv">
				<p class="left">Select Item To Delete</p>
				<!--  action="delete_complete.php"  OLD -->
				<form class="left"method="post">
					<?php
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						
						include "executeQuery.php";
						include "renderListBox.php";
						
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `items`";
						renderListBox($query, $con); // itemID is del variable name
						
						
						mysql_close($con);
					?>
					
					<button onclick="return del(false)">Submit</button>
				</form>
			</div>