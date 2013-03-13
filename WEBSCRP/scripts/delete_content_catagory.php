<div id="catForm" class="rightDiv">
				<p class="left"> Select a Catagory</p>
				<form class="left" action="delete_complete.php" method="post">
					<?php
						
						include "executeQuery.php";
						include "renderListBox.php";
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con); // catagoryID is del variable name
						
						
						mysql_close($con);
						
						echo "<input type='hidden' name='deleteType' value='cat'>";
						
						echo "<input type='submit' name='submit' value='delete'>"
					?>
				</form>
			</div>