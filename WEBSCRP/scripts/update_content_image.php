<div id="catForm" class="leftDiv"> <!-- sift right -->
				<p class="left"> Select an Item</p>
				<!-- action="update_catagory.php" -->

				
				<form class="left" enctype="multipart/form-data" method="post">
				
					
					<?php
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						include "mysql.php";
						
						// renders list box
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `items`";
						renderListBox($query, $con);
						
						mysql_close($con);
						
						// Drag And Drop Rendered Seperatley (on page load)
					?>
						
						<!--  DRAG AND DROP HANDLES EVERYTHING <button onclick="">Submit</button> <!-- add oinclick-->
						
						
					<p id="dynamicText"></p>
				</form>
					

			</div>