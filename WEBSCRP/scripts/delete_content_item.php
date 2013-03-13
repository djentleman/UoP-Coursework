<div id="itemForm" class="leftDiv">
				<p class="left">Select Item To Delete</p>
				<form class="left" action="delete_complete.php" method="post">
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
						
						echo "<input type='hidden' name='deleteType' value='item'>";
						
						echo "<input type='submit' name='submit' value='delete'>"
					?>
				</form>
			</div>